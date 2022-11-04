<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col justify-center items-center pt-4">
        <div class="text-center">
            <Link href="/" class="text-4xl font-bold">KUMBAH</Link>
        </div>
        <div class="w-full md:max-w-md mt-6 px-6 py-4">
            <slot />
        </div>
        <slot name="footer" />
    </div>
</template>
