<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import Pagination from '@/Components/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TableList from '@/Components/TableList.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

defineProps({
    services: Object
});

const modal = {
    show: ref(false),
    title: ref('Add'),
    btnText: ref('Add'),
};

const head = [
    { key: 'id', label: 'ID', sortable: true, type: 'Number' },
    { key: 'name', label: 'Service Name', sortable: true, type: 'String' },
    { key: 'price', label: 'Price', sortable: true, type: 'Number' },
    { key: 'unit', label: 'Unit', sortable: false },
]

const form = useForm({
    id: '',
    name: '',
    price: '',
    unit: '',
});

function showModal(type, item) {
    const { show, title, btnText } = modal;

    if (type === 'edit') {
        form.id = item.id;
        form.name = item.name;
        form.price = item.price;
        form.unit = item.unit;

        title.value = 'Edit';
        btnText.value = 'Save';
    } else {
        title.value = 'Add';
        btnText.value = 'Add';
    }
    show.value = true;
}

function submit(type) {
    if (type === 'Add') {
        form.post(route('service.store'), {
            onSuccess() {
                closeModal();
            },
            preserveState: false
        });
    } else {
        form.post(route('service.update'), {
            onSuccess() {
                closeModal();
            },
            preserveState: false
        });
    }
}

function closeModal() {
    form.reset();
    modal.show.value = false;
}
</script>

<template>

    <Head title="Service" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Service</h2>
            </div>
            <div class="mt-20 mx-auto max-w-7xl">
                <TableList :head="head" :data="services.data" action="modal" @edit="showModal">
                    <div class="flex justify-end mb-5">
                        <PrimaryButton class="px-3 2xl:text-base" @click="showModal('add')">
                            Add Service
                        </PrimaryButton>
                    </div>
                    <template #pagination>
                        <Pagination :links="services.links" />
                    </template>
                </TableList>
            </div>
        </div>
        <Teleport to="body">
            <!-- Add modal -->
            <Modal :show="modal.show.value" :form="true" @close="closeModal()" @ok="submit(modal.title.value)">
                <!-- Input name -->
                <h3 class="mb-6 font-bold text-center text-primary-800 text-xl">{{ modal.title.value }} Service</h3>
                <div>
                    <InputLabel for="name" value="Name" class="mb-2" />
                    <TextInput v-model="form.name" id="name" type="text" class="w-full" />
                    <InputError :message="form.errors.name" class="mt-1.5" />
                </div>
                <!-- Input price -->
                <div class="mt-3">
                    <InputLabel for="price" value="Price" class="mb-2" />
                    <TextInput v-model="form.price" id="price" type="number" class="w-full" />
                    <InputError :message="form.errors.price" class="mt-1.5" />
                </div>
                <!-- Input unit -->
                <div class="mt-3">
                    <InputLabel for="unit" value="Unit" class="mb-2" />
                    <SelectInput v-model="form.unit" id="unit" class="w-full">
                        <option value="" :selected="form.unit === ''">Select the service unit</option>
                        <option value="Kg" :selected="form.unit === 'Kg'">Kg</option>
                        <option value="Pcs" :selected="form.unit === 'Pcs'">Pcs</option>
                    </SelectInput>
                    <!-- <TextInput v-model="form.unit" id="unit" type="text" class="w-full" required /> -->
                    <InputError :message="form.errors.unit" class="mt-1.5" />
                </div>
                <template #yesButton>{{ modal.btnText.value }}</template>
                <template #noButton>Cancel</template>
            </Modal>
        </Teleport>
    </AuthenticatedLayout>
</template>
