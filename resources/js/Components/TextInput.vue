<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>

<template>
    <input
        class="text-black border-slate-400 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-md read-only:bg-slate-100 read-only:focus:ring-0"
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input" />
</template>
