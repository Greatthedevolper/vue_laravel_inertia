<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthLayout from "../../Layouts/AuthLayout.vue";
import Input from "../../components/Input.vue";
defineOptions({ layout: AuthLayout });
const form = useForm({
    email: null,
    password: null,
    remember: false,
});
function submit() {
    form.post(route("login"), {
        onError: () => form.reset("password"),
    });
    console.log(form);
}
</script>
<template>
    <Head :title="`Login`" />
    <form class="auth-form" @submit.prevent="submit">
        <Input
            name="email"
            type="email"
            v-model="form.email"
            :message="form.errors.email"
        />
        <Input
            name="password"
            type="password"
            v-model="form.password"
            :message="form.errors.password"
        />
        <div class="flex items-center justify-between mb-4 flex-wrap">
            <label
                for="remember-me"
                class="flex items-center gap-2 cursor-pointer"
            >
                <input
                    type="checkbox"
                    id="remember-me"
                    v-model="form.remember"
                />
                <span class="select-none">Remember Me</span>
            </label>
            <div class="flex items-center md:gap-2 gap-1 justify-end grow">
                <span class="select-none">Have No account?</span>
                <Link :href="route('signup')" class="underline"
                    >Sign Up Here</Link
                >
            </div>
        </div>

        <button
            type="submit"
            :disabled="form.processing"
            class="btn btn-warning w-full"
        >
            <span>Login</span>
            <span v-if="form.processing">Loading</span>
        </button>
    </form>
</template>
