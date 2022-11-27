<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active ? 'bg-secondary-400 text-black' : 'bg-transparent hover:bg-primary-400');
</script>

<template>
    <Link :href="href" :class="classes"
        class="flex py-2.5 px-2.5 items-center gap-3 transition-all duration-300 rounded-lg">
    <slot />
    <span class="font-semibold text-base xl:text-lg">
        <slot name="text" />
    </span>
    </Link>
</template>
