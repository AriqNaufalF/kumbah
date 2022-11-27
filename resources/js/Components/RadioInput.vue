<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: {
        type: String,
        required: true,
    },
    name: {
        type: String,
        default: 'group',
    },
    value: {
        type: String,
        default: undefined,
    },
    checked: {
        default: '',
    }
});
const emit = defineEmits(['update:checked']);
const isChecked = computed({
    get() {
        return props.checked;
    },
    set(val) {
        return emit('update:checked', val);
    }
});
</script>

<template>
    <div class="flex items-center">
        <label class="font-medium text-sm ml-2">
            <input :name="name" type="radio" :value="value" v-model="isChecked" />
            {{ label }}
        </label>
    </div>
</template>
