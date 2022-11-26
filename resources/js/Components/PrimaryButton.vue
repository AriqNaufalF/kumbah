<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button
        :type="type"
        class="py-1.5 text-sm font-medium bg-primary-600 text-white rounded-md shadow-md transition-transform hover:scale-105"
    >
        <slot />
    </button>
</template>
