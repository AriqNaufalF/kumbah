<script setup>
defineEmits(['update:modelValue']);
defineProps(['modelValue']);
</script>

<template>
    <textarea @input="$emit('update:modelValue', $event.target.value)" :value="modelValue"
        class="text-black border-slate-400 focus:border-blue-300 focus:ring focus:ring-blue-200 zfocus:ring-opacity-50 rounded-md shadow-md"></textarea>
</template>
