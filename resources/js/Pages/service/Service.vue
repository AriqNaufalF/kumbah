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

const data = [
    { id: 1, name: 'Cuci cepat', price: '8.000', unit: 'Kg' },
    { id: 2, name: 'Cuci normal', price: '5.000', unit: 'Kg' },
    { id: 3, name: 'Cuci seprai', price: '10.000', unit: 'Pcs' },
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
            <div class="mt-20">
                <TableList>
                    <div class="flex justify-end mb-5">
                        <PrimaryButton class="px-3 2xl:text-base" @click="showModal('add')">
                            Add Service
                        </PrimaryButton>
                    </div>
                    <template #thead>
                        <th class="py-3 px-3.5">ID</th>
                        <th class="py-3 px-3.5">Service Name</th>
                        <th class="py-3 px-3.5">Price</th>
                        <th class="py-3 px-3.5">Unit</th>
                        <th class="py-3 px-3.5">Action</th>
                    </template>
                    <template #tbody>
                        <tr class="group hover:bg-slate-50" v-for="item in data">
                            <td class="py-3 px-3.5">{{ item.id }}</td>
                            <td class="py-3 px-3.5">{{ item.name }}</td>
                            <td class="py-3 px-3.5">{{ item.price }}</td>
                            <td class="py-3 px-3.5">{{ item.unit }}</td>
                            <td class="py-3 px-3.5">
                                <button type="button" @click="showModal('edit', item)">
                                    <span class="sr-only">Edit</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" height="24" width="24"
                                        class="inline hover:scale-x-110">
                                        <path
                                            d="M9 47.4q-1.2 0-2.1-.9-.9-.9-.9-2.1v-30q0-1.2.9-2.1.9-.9 2.1-.9h20.25L15 25.7v12.7h12.7L42 24v20.4q0 1.2-.9 2.1-.9.9-2.1.9Zm9-12v-8.5l15.1-15.1 8.55 8.4L26.5 35.4Zm25.8-17.35-8.55-8.4L38.1 6.8q.85-.85 2.125-.85t2.125.9l4.2 4.25q.85.9.85 2.125t-.9 2.075Z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </template>
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
