<script setup>
import { Link } from '@inertiajs/inertia-vue3';
defineProps({
    href: {
        type: String,
    },
    text: {
        type: String,
        default: 'Button Link'
    },
    custom: {
        type: Boolean,
        default: false
    }
})
</script>

<template>
    <Link :href="href"
        :class="custom ? '' : 'px-3 py-1.5 bg-primary-600 font-medium text-sm text-white rounded-md shadow-md transition-all hover:scale-105 hover:bg-primary-800 2xl:text-base'">
    {{ text }}
    </Link>
</template>
