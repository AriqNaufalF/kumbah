<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head, usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const showModal = ref(false);
const { id, name, email, gender, phone, address, isAdmin } = usePage().props.value.employee;
const form = useForm({
    name: name,
    email: email,
    gender: gender,
    phone: phone,
    address: address,
    password: '',
    isAdmin: !!isAdmin
});

function submit() {
    form.post(route('employee.update', id), {
        onSuccess: () => form.reset()
    });
}

function deleteAccount() {
    form.delete('/delete');
}

</script>

<template>

    <Head title="Edit Employee" />
    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Edit Employee</h2>
            </div>
            <div class="mt-10 mx-auto max-w-7xl">
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
                                <!-- Input gender -->
                                <div class="mt-3">
                                    <InputLabel for="gender" value="Gender" class="mb-2" />
                                    <SelectInput v-model="form.gender" id="gender" class="w-full" required>
                                        <option value="" selected>Select gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </SelectInput>
                                    <InputError :message="form.errors.gender" class="mt-1.5" />
                                </div>
                                <!-- Input address -->
                                <div class="mt-3">
                                    <InputLabel for="address" value="Address" class="mb-2" />
                                    <TextAreaInput v-model="form.address" id="address" rows="6" class="w-full resize-y"
                                        required />
                                    <InputError :message="form.errors.address" class="mt-1.5" />
                                </div>
                            </div>
                            <div class="h-full flex flex-col">
                                <!-- Input email -->
                                <div>
                                    <InputLabel for="email" value="Email" class="mb-2" />
                                    <TextInput v-model="form.email" id="email" type="email" class="w-full" required />
                                    <InputError :message="form.errors.email" class="mt-1.5" />
                                </div>
                                <!-- Input phone -->
                                <div class="mt-3">
                                    <InputLabel for="phone" value="Phone Number" class="mb-2" />
                                    <TextInput v-model="form.phone" id="phone" type="tel" class="w-full" required />
                                    <InputError :message="form.errors.phone" class="mt-1.5" />
                                </div>
                                <!-- Input password -->
                                <div class="mt-3">
                                    <InputLabel for="password" value="Password" class="mb-2" />
                                    <TextInput v-model="form.password" id="password" type="password" class="w-full"
                                        required />
                                    <InputError :message="form.errors.password" class="mt-1.5" />
                                </div>
                                <!-- Input isadmin -->
                                <div class="mt-3">
                                    <label class="flex items-center">
                                        <Checkbox v-model:checked="form.isAdmin" />
                                        <span class="ml-2 font-medium text-sm">Admin</span>
                                    </label>
                                </div>
                                <div class="mt-auto ml-auto">
                                    <SecondaryButton class="px-6 py-1.5" type="button" @click="showModal = true">Delete
                                    </SecondaryButton>
                                    <PrimaryButton class="ml-3 px-6 py-1.5" :class="{ 'opacity-25': form.processing }"
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
            <Modal :show="showModal" @close="showModal = false" @ok="deleteAccount">
                <svg xmlns="http://www.w3.org/2000/svg" height="56" width="56" viewBox="0 0 48 48"
                    class="mx-auto mb-4 fill-red-600">
                    <path
                        d="M2 42 24 4l22 38Zm22.2-5.85q.65 0 1.075-.425.425-.425.425-1.075 0-.65-.425-1.075-.425-.425-1.075-.425-.65 0-1.075.425Q22.7 34 22.7 34.65q0 .65.425 1.075.425.425 1.075.425Zm-1.5-5.55h3V19.4h-3Z" />
                </svg>
                <h3 class="mb-5 text-lg">Are you sure want to delete this account?</h3>
            </Modal>
        </Teleport>
    </AuthenticatedLayout>
</template>
