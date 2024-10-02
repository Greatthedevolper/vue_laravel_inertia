<script setup>
import { useForm } from "@inertiajs/vue3";
import { getAuth, createUserWithEmailAndPassword } from "firebase/auth";
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Input from "../../components/Input.vue";
const auth = getAuth();
defineOptions({ layout: AuthLayout });
const form = useForm({
    avatar: null,
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    token: null,
    remember: false,
    avatar_preview: null,
});
function submit() {
    createUserWithEmailAndPassword(auth, form.email, form.password)
        .then(async (userCredential) => {
            const idToken = await userCredential.user.getIdToken();
            form.token = idToken;
            form.post(route("signup"), {
                onError: () => form.reset("password_confirmation"),
            });
        })
        .catch((error) => {
            console.error("Firebase auth error:", error);
        });
}
const uploadAvatar = (e) => {
    form.avatar = e.target.files[0];
    form.avatar_preview = URL.createObjectURL(e.target.files[0]);
};
</script>
<template>
    <Head :title="`Sign Up`" />
    <form class="auth-form" @submit.prevent="submit">
        <div class="flex items-end justify-between gap-2">
            <Input
                class="grow !mb-0"
                name="Profile image"
                type="file"
                inputId="avatar"
                :message="form.errors.avatar"
                @input="uploadAvatar"
            />
            <div v-if="form.avatar_preview">
                <img
                    :src="
                        form.avatar_preview
                            ? form.avatar_preview
                            : 'storage/avatars/default-image.png'
                    "
                    alt=""
                    class="w-[100px] h-[60px] border border-red-400 rounded-full"
                />
            </div>
        </div>
        <Input
            name="name"
            type="text"
            v-model="form.name"
            :message="form.errors.name"
            inputId="name"
        />
        <Input
            name="email"
            type="email"
            v-model="form.email"
            :message="form.errors.email"
            inputId="email"
        />
        <Input
            name="password"
            type="password"
            v-model="form.password"
            :message="form.errors.password"
            inputId="password"
        />
        <Input
            name="Confirm password"
            type="password"
            v-model="form.password_confirmation"
            inputId="confirm_password"
        />
        <div class="flex items-center justify-between mb-4">
            <label for="remember-me" class="flex items-center gap-2">
                <input type="checkbox" id="remember-me" v-model="form.agreed" />
                <span class="select-none"
                    >I agreed
                    <Link :href="route('home')" class="underline"
                        >Terms & Conditions</Link
                    ></span
                >
            </label>
            <div class="flex items-center gap-2">
                <span class="select-none">Already have account?</span>
                <Link :href="route('login')" class="underline">Login Here</Link>
            </div>
        </div>
        <button
            type="submit"
            :disabled="form.processing"
            class="btn btn-warning w-full"
        >
            <span> Sign Up</span>
            <span v-if="form.processing">Loading</span>
        </button>
    </form>
</template>
