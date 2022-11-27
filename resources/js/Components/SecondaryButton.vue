<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type"
        class="py-1.5 text-sm font-medium bg-secondary-400 text-black rounded-md shadow-md transition-all hover:scale-105 hover:bg-secondary-600">
        <slot />
    </button>
</template>
