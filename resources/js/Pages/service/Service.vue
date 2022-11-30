<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TableList from '@/Components/TableList.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

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
const data = [
    { id: 1, name: 'Cuci cepat', price: 8000, unit: 'Kg' },
    { id: 2, name: 'Cuci normal', price: 5000, unit: 'Kg' },
    { id: 3, name: 'Cuci seprai', price: 10000, unit: 'Pcs' },
];

const form = useForm({
    name: '',
    price: '',
    unit: '',
});

function showModal(type, item) {
    const { show, title, btnText } = modal;

    if (type === 'edit') {
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
    if (type === 'add') {
        form.post(route('test'), {
            onSuccess() {
                closeModal();
            }
        });
    } else {
        form.post(route('test'), {
            onSuccess() {
                closeModal();
            }
        });
    }
}

function closeModal() {
    form.reset();
    modal.show.value = false;
}
</script>

<template>

    <Head title="Employee" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Service</h2>
            </div>
            <div class="mt-20 mx-auto max-w-7xl">
                <TableList :head="head" :data="data" action="modal" @edit="showModal">
                    <div class="flex justify-end mb-5">
                        <PrimaryButton class="px-3 2xl:text-base" @click="showModal('add')">
                            Add Service
                        </PrimaryButton>
                    </div>
                </TableList>
            </div>
        </div>
        <Teleport to="body">
            <!-- Add modal -->
            <Modal :show="modal.show.value" :form="true" @close="closeModal()" @ok="submit('add')">
                <!-- Input name -->
                <h3 class="mb-6 font-bold text-center text-primary-800 text-xl">{{ modal.title.value }} Service</h3>
                <div>
                    <InputLabel for="name" value="Name" class="mb-2" />
                    <TextInput v-model="form.name" id="name" type="text" class="w-full" required />
                    <InputError :message="form.errors.name" class="mt-1.5" />
                </div>
                <!-- Input price -->
                <div class="mt-3">
                    <InputLabel for="price" value="Price" class="mb-2" />
                    <TextInput v-model="form.price" id="price" type="number" class="w-full" required />
                    <InputError :message="form.errors.price" class="mt-1.5" />
                </div>
                <!-- Input unit -->
                <div class="mt-3">
                    <InputLabel for="unit" value="Unit" class="mb-2" />
                    <TextInput v-model="form.unit" id="unit" type="text" class="w-full" required />
                    <InputError :message="form.errors.unit" class="mt-1.5" />
                </div>
                <template #yesButton>{{ modal.btnText.value }}</template>
                <template #noButton>Cancel</template>
            </Modal>
        </Teleport>
    </AuthenticatedLayout>
</template>
