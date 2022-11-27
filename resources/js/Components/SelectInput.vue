<script setup>
defineProps(['modelValue']);
defineEmits(['update:modelValue']);
</script>

<template>
    <select @change="$emit('update:modelValue', $event.target.value)" :value="modelValue"
        class="text-black border-slate-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-md">
        <slot />
    </select>
</template>
