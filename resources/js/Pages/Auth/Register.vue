<script setup>
import authLayout from "../../Layouts/AuthLayout.vue";
import InputComponent from "../../Components/InputComponent.vue";
import { useForm } from "@inertiajs/vue3";
import { createUserWithEmailAndPassword } from "firebase/auth";
import { auth } from "../../firebase";
import axios from "axios";

defineOptions({ layout: authLayout });

// Form state and fields
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    agreed: false,
});

// Client-side validation before sending request to Firebase
const validateFields = () => {
    if (!form.name) {
        form.setError('name', 'Name is required');
        return false;
    }
    if (!form.email) {
        form.setError('email', 'Email is required');
        return false;
    }
    if (!form.password) {
        form.setError('password', 'Password is required');
        return false;
    }
    if (form.password !== form.password_confirmation) {
        form.setError('password_confirmation', 'Passwords do not match');
        return false;
    }
    if (!form.agreed) {
        form.setError('agreed', 'You must agree to the terms');
        return false;
    }
    return true;
};

const register = async () => {
    if (!validateFields()) {
        return; // Stop if client-side validation fails
    }

    try {
        // Firebase user creation
        const userCredential = await createUserWithEmailAndPassword(auth, form.email, form.password);
        const user = userCredential.user;
        const idToken = await user.getIdToken();

        // Send the data to the Laravel backend for server-side validation
        await axios.post("/register", {
            name: form.name,
            email: form.email,
            token: idToken,
        });

        console.log("Registration successful");

    } catch (error) {
        console.error("Registration error:", error);
        // Optionally handle Firebase errors (e.g., weak password, email in use)
        form.setError('firebase', error.message);
    }
};
</script>

<template>
  <Head title="Register" />
  <div class="form-wrapper">
    <h3 class="text-yellow-600 text-center">Welcome! Register Yourself</h3>
    <form @submit.prevent="register">
      <!-- Fields with error messages from client-side or server-side -->
      <InputComponent inputName="name" inputType="text" inputId="name" v-model="form.name" :message="form?.errors?.name" />
      <InputComponent inputName="email" inputType="email" inputId="email" v-model="form.email" :message="form?.errors?.email" />
      <InputComponent inputName="password" inputType="password" inputId="password" v-model="form.password" :message="form?.errors?.password" />
      <InputComponent inputName="Confirm password" inputType="password" inputId="confirm-password" v-model="form.password_confirmation" :message="form?.errors?.password_confirmation" />

      <!-- Agreement checkbox -->
      <div class="flex items-center justify-between mb-3">
        <label for="agreed" class="flex items-center gap-2">
          <input type="checkbox" id="agreed" v-model="form.agreed" />
          <span>I agree to all <Link :href="route('login')" class="text-yellow-600">Conditions</Link></span>
        </label>
        <p>
          <span>Already have an account? <Link :href="route('login')" class="text-yellow-600">Login</Link></span>
        </p>
      </div>

      <div>
        <button type="submit" class="form-button">Register</button>
      </div>
    </form>
  </div>
</template>
