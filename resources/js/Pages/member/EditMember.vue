<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import RadioInput from '@/Components/RadioInput.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head, usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const showModal = ref(false);
const form = useForm({
    name: usePage().props.value.name,
    email: '',
    phone: '',
    type: 'silver',
    start: '',
    end: '',
})

function submit() {
    form.post(route('test'), {
        onSuccess: () => form.reset()
    });
}

function deleteMember() {
    form.delete('/delete');
}
</script>

<template>

    <Head title="Add Employee" />
    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Edit Member</h2>
            </div>
            <div class="mt-20 mx-auto max-w-7xl">
                <div class="p-6 bg-white shadow-lg rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-2 gap-6 mx-auto max-w-7xl">
                            <div>
                                <!-- Input name -->
                                <div>
                                    <InputLabel for="name" value="Name" class="mb-2" />
                                    <TextInput v-model="form.name" id="name" type="text" class="w-full" required
                                        autofocus />
                                    <InputError :message="form.errors.name" class="mt-1.5" />
                                </div>
                                <!-- Input email -->
                                <div class="mt-3">
                                    <InputLabel for="email" value="Email" class="mb-2" />
                                    <TextInput v-model="form.email" id="email" type="email" class="w-full" required />
                                    <InputError :message="form.errors.email" class="mt-1.5" />
                                </div>
                                <!-- Input type -->
                                <div class="mt-3">
                                    <span class="block mb-2 font-medium text-sm">Member Type</span>
                                    <RadioInput v-model:checked="form.type" name="type" value="silver" label="Silver" />
                                    <RadioInput v-model:checked="form.type" name="type" value="gold" label="Gold"
                                        class="mt-2" />
                                    <RadioInput v-model:checked="form.type" name="type" value="platinum"
                                        label="Platinum" class="mt-2" />
                                    <InputError :message="form.errors.type" class="mt-1.5" />
                                </div>
                            </div>
                            <div class="h-full flex flex-col">
                                <!-- Input phone -->
                                <div>
                                    <InputLabel for="phone" value="Phone Number" class="mb-2" />
                                    <TextInput v-model="form.phone" id="phone" type="tel" class="w-full" required />
                                    <InputError :message="form.errors.phone" class="mt-1.5" />
                                </div>
                                <!-- Input start -->
                                <div class="mt-3">
                                    <InputLabel for="start" value="Start Date" class="mb-2" />
                                    <TextInput v-model="form.start" id="start" type="date" class="w-full" required />
                                    <InputError :message="form.errors.start" class="mt-1.5" />
                                </div>
                                <!-- Input end -->
                                <div class="mt-3">
                                    <InputLabel for="end" value="End Date" class="mb-2" />
                                    <TextInput v-model="form.end" id="end" type="date" class="w-full" required />
                                    <InputError :message="form.errors.end" class="mt-1.5" />
                                </div>
                                <div class="mt-10 ml-auto">
                                    <SecondaryButton class="px-6 py-1.5" type="button" @click="showModal = true">Delete
                                    </SecondaryButton>
                                    <PrimaryButton class="px-6 py-1.5 ml-3" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        Save
                                    </PrimaryButton>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <Teleport to="body">
            <Modal :show="showModal" @close="showModal = false" @ok="deleteMember">
                <svg xmlns="http://www.w3.org/2000/svg" height="56" width="56" viewBox="0 0 48 48"
                    class="mx-auto mb-4 fill-red-600">
                    <path
                        d="M2 42 24 4l22 38Zm22.2-5.85q.65 0 1.075-.425.425-.425.425-1.075 0-.65-.425-1.075-.425-.425-1.075-.425-.65 0-1.075.425Q22.7 34 22.7 34.65q0 .65.425 1.075.425.425 1.075.425Zm-1.5-5.55h3V19.4h-3Z" />
                </svg>
                <h3 class="mb-5 text-lg">Are you sure want to delete this member?</h3>
            </Modal>
        </Teleport>
    </AuthenticatedLayout>
</template>
