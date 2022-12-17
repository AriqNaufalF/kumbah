<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { watch, ref } from 'vue';

const show = ref(false);
const timeout = ref(null);
watch(usePage().props.value.flash, () => {
    setTimeout(() => {
        show.value = true;
    }, 100);
    if (timeout.value) {
        clearTimeout(timeout.value);
    }
    timeout.value = setTimeout(() => {
        show.value = false;
    }, 3000);
}, { deep: true, immediate: true });
</script>

<template>
    <Transition enter-from-class="-translate-x-full" enter-to-class="translate-x-0"
        enter-active-class="transition-all duration-300" leave-active-class="transition-all duration-300"
        leave-to-class="-translate-x-full">
        <div v-if="$page.props.flash.success && show" class="fixed left-56 top-7">
            <div class="p-3 bg-green-200 text-black border-r-8 border-green-600 rounded-r-lg">
                <div class="flex items-center gap-3">
                    <div class="min-w-[theme(spacing.72)]">
                        <p class="font-semibold text-lg">Success</p>
                        <p class="text-lg">{{ $page.props.flash.success }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path
                            d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                        <path
                            d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                    </svg>
                </div>
            </div>
        </div>
    </Transition>
</template>
