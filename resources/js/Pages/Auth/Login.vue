<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />
        <!-- Left section -->
        <div class="hidden px-4 min-h-screen w-full bg-primary-600 md:w-1/2 md:flex md:items-center md:justify-center">
            <div class="max-w-md 2xl:max-w-lg">
                <img src="/svg/login_illustration.svg" alt="Login illustration" />
            </div>
        </div>
        <!-- Rigth section -->
        <div class="relative flex items-center justify-center min-h-screen w-full md:w-1/2 overflow-hidden">
            <div class="w-full px-4 max-w-md 2xl:max-w-lg">
                <!-- wave -->
                <div class="hidden absolute -z-10 left-0 top-0 bottom-0 aspect-[3/16] lg:block">
                    <svg viewBox="0 0 192 1080" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M85.3333 1080L92.4667 1057.5C99.3333 1035 114 990 124.467 945C135.333 900 142 855 142.2 810C142 765 135.333 720 124.467 675C114 630 99.3333 585 81.8 540C64 495 42.6667 450 53.3333 405C64 360 106.667 315 113.8 270C120.667 225 92.6667 180 99.5333 135C106.667 90 149.333 45 170.667 22.5L192 0H0V22.5C0 45 0 90 0 135C0 180 0 225 0 270C0 315 0 360 0 405C0 450 0 495 0 540C0 585 0 630 0 675C0 720 0 765 0 810C0 855 0 900 0 945C0 990 0 1035 0 1057.5V1080H85.3333Z"
                            fill="#8980F5" />
                    </svg>
                </div>
                <!-- Header -->
                <div class="text-center mb-4">
                    <h1 class="font-bold text-4xl text-primary-600">KUMBAH</h1>
                </div>
                <!-- form -->
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email" />
                        <InputError class="mt-2 mb-1" :message="form.errors.email" />
                        <TextInput id="email" type="text" v-model="form.email" required autofocus autocomplete="email"
                            class="w-full" />
                    </div>
                    <div class="mt-3">
                        <InputLabel for="password" value="Password" />
                        <InputError class="mt-2 mb-1" :message="form.errors.password" />
                        <TextInput id="password" type="password" v-model="form.password" required
                            autocomplete="password" class="w-full" />
                    </div>

                    <div class="block mt-3">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ml-2 font-medium text-sm">Remember me</span>
                        </label>
                    </div>

                    <div class="mt-3">
                        <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            LOG IN
                        </PrimaryButton>
                        <Link v-if="canResetPassword" :href="route('password.request')"
                            class="block mt-3 underline text-center text-sm text-slate-400 hover:text-primary-600">
                        Forgot your password?</Link>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>
