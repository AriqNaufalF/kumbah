<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import RadioInput from '@/Components/RadioInput.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    type: '',
    start: '',
    end: '',
})

function submit() {
    form.post(route('member.store'), {
        onSuccess: () => form.reset()
    })
}

</script>

<template>

    <Head title="Add Member" />
    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Add Member</h2>
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
                                <!-- Input email -->
                                <div class="mt-3">
                                    <InputLabel for="email" value="Email" class="mb-2" />
                                    <TextInput v-model="form.email" id="email" type="email" class="w-full" required />
                                    <InputError :message="form.errors.email" class="mt-1.5" />
                                </div>
                                <!-- Input type -->
                                <div class="mt-3">
                                    <span class="block mb-2 font-medium text-sm">Member Type</span>
                                    <RadioInput v-model:checked="form.type" name="type" value="1" label="Silver" />
                                    <RadioInput v-model:checked="form.type" name="type" value="2" label="Gold"
                                        class="mt-2" />
                                    <RadioInput v-model:checked="form.type" name="type" value="3" label="Platinum"
                                        class="mt-2" />
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
