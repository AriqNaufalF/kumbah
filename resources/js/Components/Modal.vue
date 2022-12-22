<script setup>
import PrimaryButton from './PrimaryButton.vue';
import SecondaryButton from './SecondaryButton.vue';

defineProps({
    show: Boolean,
    form: {
        type: Boolean,
        default: false,
    }
});
</script>

<template>
    <Transition name="modal">
        <div v-if="show" aria-hidden="true" class="fixed z-50 inset-0 bg-slate-400/20">
            <div class="grid place-content-center min-h-screen">
                <div class="relative bg-white rounded-lg overflow-hidden">
                    <div class="relative p-6">
                        <button type="button" @click="$emit('close')"
                            class="absolute top-3 right-3 p-1.5 hover:bg-slate-100 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                            <span class="sr-only">close</span>
                        </button>
                        <div v-if="form">
                            <form @submit.prevent="$emit('postForm')">
                                <slot />
                                <div class="flex mt-6 justify-end">
                                    <SecondaryButton type="button" class="px-6 py-1.5" @click="$emit('close')">
                                        <slot name="noButton">No, cancel</slot>
                                    </SecondaryButton>
                                    <PrimaryButton class="px-6 py-1.5 ml-4">
                                        <slot name="yesButton">Yes, I'm sure</slot>
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                        <div class="text-center" v-else>
                            <slot />
                            <form @submit.prevent="$emit('postForm')">
                                <SecondaryButton type="button" class="mr-4 px-6 py-1.5" @click="$emit('close')">
                                    <slot name="noButton">No, cancel</slot>
                                </SecondaryButton>
                                <PrimaryButton class="px-6 py-1.5">
                                    <slot name="yesButton">Yes, I'm sure</slot>
                                </PrimaryButton>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<style>
.modal-enter-active,
.modal-leave-active {
    @apply transition-all duration-500;
}

.modal-enter-from,
.modal-leave-to {
    @apply opacity-0;
}

.modal-leave-to {
    @apply scale-150;
}
</style>
