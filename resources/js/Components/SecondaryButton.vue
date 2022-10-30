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
        class="py-1.5 text-sm font-medium bg-secondary-400 text-black rounded-md hover:shadow-lg active:bg-secondary-500"
    >
        <slot />
    </button>
</template>

<style scoped>
button {
    box-shadow: inset 1px -3px 6px -2px theme('colors.secondary.500'),
        inset -1px 0 6px -2px theme('colors.secondary.500');
}
</style>
