<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="min-h-screen grid pt-4">
        <div class="text-center self-end">
            <Link href="/" class="text-4xl font-bold">KUMBAH</Link>
        </div>
        <div class="w-full sm:max-w-md mt-6 mx-auto px-6 py-4">
            <slot />
        </div>
        <slot name="footer" />
    </div>
</template>
