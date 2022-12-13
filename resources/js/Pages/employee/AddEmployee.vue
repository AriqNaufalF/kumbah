<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    gender: '',
    phone: '',
    address: '',
    password: '',
    isAdmin: false
})

function submit() {
    form.post(route('employee.store'), {
        onSuccess: () => form.reset()
    })
}

</script>

<template>

    <Head title="Add Employee" />
    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Add Employee</h2>
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
                                <!-- Input gender -->
                                <div class="mt-3">
                                    <InputLabel for="gender" value="Gender" class="mb-2" />
                                    <SelectInput v-model="form.gender" id="gender" class="w-full" required>
                                        <option value="" selected>Select gender</option>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
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
                                    <PrimaryButton class="px-6 py-1.5" :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        Add
                                    </PrimaryButton>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
