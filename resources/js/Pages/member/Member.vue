<script setup>
import ButtonLink from '@/Components/ButtonLink.vue';
import Modal from '@/Components/Modal.vue';
import TableList from '@/Components/TableList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const showModal = ref(false);
const form = useForm({
    name: '',
    discount: ''
});

const memberType = [
    { name: 'Silver', discount: 5 },
    { name: 'Gold', discount: 10 },
    { name: 'Platinum', discount: 15 },
]

function editType(item) {
    showModal.value = true;
    form.name = item.name;
    form.discount = item.discount;
}

function saveFormType() {
    form.post(route('test'), {
        onSuccess() {
            form.reset();
            showModal.value = false;
        }
    })
}

function closeForm() {
    form.reset();
    showModal.value = false;
}
</script>

<template>

    <Head title="Employee" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Member List</h2>
            </div>
            <!-- Member type -->
            <div class="mt-10">
                <div class="p-6 bg-white shadow-lg rounded-lg">
                    <div class="grid grid-flow-col gap-4 xl:grid-cols-3 2xl:justify-items-center 2xl:gap-0">
                        <!-- Card -->
                        <div class="relative p-3 pr-10 w-full h-28 max-w-xs bg-primary-800 text-white rounded-md 2xl:h-32 2xl:max-w-sm"
                            v-for="item in memberType">
                            <button type="button" class="absolute top-3 right-3" @click="editType(item)">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" height="24" width="24"
                                    class="inline hover:scale-x-110 fill-white">
                                    <path
                                        d="M9 47.4q-1.2 0-2.1-.9-.9-.9-.9-2.1v-30q0-1.2.9-2.1.9-.9 2.1-.9h20.25L15 25.7v12.7h12.7L42 24v20.4q0 1.2-.9 2.1-.9.9-2.1.9Zm9-12v-8.5l15.1-15.1 8.55 8.4L26.5 35.4Zm25.8-17.35-8.55-8.4L38.1 6.8q.85-.85 2.125-.85t2.125.9l4.2 4.25q.85.9.85 2.125t-.9 2.075Z" />
                                </svg>
                                <span class="sr-only">Edit member type</span>
                            </button>
                            tipe: {{ item.name }}
                            diskon: {{ item.discount }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Member list -->
            <div class="mt-10">
                <TableList>
                    <div class="flex justify-end mb-5">
                        <ButtonLink :href="route('member.add')" text="Add Member" />
                    </div>
                    <template #thead>
                        <th class="py-3 px-3.5">ID</th>
                        <th class="py-3 px-3.5">Name</th>
                        <th class="py-3 px-3 5">Type</th>
                        <th class="py-3 px-3.5">Phone Number</th>
                        <th class="py-3 px-3.5">Email</th>
                        <th class="py-3 px-3.5">Join Date</th>
                        <th class="py-3 px-3.5">Expire Date</th>
                        <th class="py-3 px-3.5">Action</th>
                    </template>
                    <template #tbody>
                        <tr class="group hover:bg-slate-50">
                            <td class="py-3 px-3.5">1</td>
                            <td class="py-3 px-3.5">Daisuke Mura</td>
                            <td class="py-3 px-3.5">Gold</td>
                            <td class="py-3 px-3.5">+62812123654782</td>
                            <td class="py-3 px-3.5">daisuke@gmail.com</td>
                            <td class="py-3 px-3.5">11-11-22</td>
                            <td class="py-3 px-3.5">12-12-22</td>
                            <td class="py-3 px-3.5">
                                <Link :href="route('member.edit')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" height="24" width="24"
                                    class="inline hover:scale-x-110">
                                    <path
                                        d="M9 47.4q-1.2 0-2.1-.9-.9-.9-.9-2.1v-30q0-1.2.9-2.1.9-.9 2.1-.9h20.25L15 25.7v12.7h12.7L42 24v20.4q0 1.2-.9 2.1-.9.9-2.1.9Zm9-12v-8.5l15.1-15.1 8.55 8.4L26.5 35.4Zm25.8-17.35-8.55-8.4L38.1 6.8q.85-.85 2.125-.85t2.125.9l4.2 4.25q.85.9.85 2.125t-.9 2.075Z" />
                                </svg>
                                </Link>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50">
                            <td class="py-3 px-3.5">2</td>
                            <td class="py-3 px-3.5">Sakura bebans</td>
                            <td class="py-3 px-3.5">Silver</td>
                            <td class="py-3 px-3.5">+6281265429831</td>
                            <td class="py-3 px-3.5">sakura@gmail.com</td>
                            <td class="py-3 px-3.5">25-11-22</td>
                            <td class="py-3 px-3.5">25-12-22</td>
                            <td class="py-3 px-3.5"></td>
                        </tr>
                    </template>
                </TableList>
            </div>
        </div>
        <Teleport to="body">
            <Modal :show="showModal" @close="closeForm" @postForm="saveFormType" :form="true">
                <!-- Input name -->
                <h3 class="mb-6 font-bold text-center text-primary-800 text-xl">{{ form.name }} Type</h3>
                <div>
                    <InputLabel for="name" value="Name" class="mb-2" />
                    <TextInput v-model="form.name" id="name" type="text" class="w-full" required />
                    <InputError :message="form.errors.name" class="mt-1.5" />
                </div>
                <!-- Input discount -->
                <div class="mt-3">
                    <InputLabel for="discount" value="Discount" class="mb-2" />
                    <TextInput v-model="form.discount" id="discount" type="number" class="w-full" required />
                    <InputError :message="form.errors.discount" class="mt-1.5" />
                </div>
                <template #yesButton>Save</template>
                <template #noButton>Cancel</template>
            </Modal>
        </Teleport>
    </AuthenticatedLayout>
</template>
