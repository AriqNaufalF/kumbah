<script setup>
import ButtonLink from '@/Components/ButtonLink.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import MemberCard from '@/Components/MemberCard.vue';
import Modal from '@/Components/Modal.vue';
import Pagination from '@/Components/Pagination.vue';
import TableList from '@/Components/TableList.vue';
import TextInput from '@/Components/TextInput.vue';
import { decimalToPercent, toRupiah } from "@/functions/numberFormat.js";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

defineProps({
    members: Object
});

const showModal = ref(false);
const form = useForm({
    name: '',
    price: '',
    discount: ''
});

const head = [
    { key: 'id', label: 'ID', sortable: true, type: 'Number' },
    { key: 'name', label: 'Name', sortable: true, type: 'String' },
    { key: 'member_type', label: 'Member Type', sortable: true, type: 'String' },
    { key: 'phone', label: 'Phone Number', sortable: false },
    { key: 'email', label: 'Email', sortable: false },
    { key: 'join_date', label: 'Join Date', sortable: true, type: 'String' },
    { key: 'expired_date', label: 'Expired Date', sortable: true, type: 'String' },
];

const memberTypes = usePage().props.value.memberTypes;

function editType(item) {
    showModal.value = true;
    form.name = item.name;
    form.price = item.price;
    form.discount = item.discount;
}

function saveFormType() {
    form.post(route('test'), {
        onSuccess() {
            closeForm();
        },
        preserveState: false,
    })
}

function closeForm() {
    form.reset();
    showModal.value = false;
}
</script>

<template>

    <Head title="Member" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Member List</h2>
            </div>
            <!-- Member type -->
            <div class="mt-10 mx-auto max-w-7xl">
                <div class="p-6 bg-white shadow-lg rounded-lg">
                    <div class="flex gap-4 overflow-x-auto lg:justify-evenly 2xl:gap-0">
                        <!-- Card silver -->
                        <MemberCard :class="`${item.name.toLowerCase()}-card`" @edit="editType(item)"
                            v-for="item in memberTypes">
                            <div class="col-start-1 row-start-1 col-span-2">
                                <p class="font-semibold text-lg leading-4 text-white">{{ item.name }}</p>
                                <p class="font-medium text-sm text-white">Discount {{ decimalToPercent(item.discount) }}
                                </p>
                            </div>
                            <div class="col-start-2 row-start-2 col-span-2 self-end justify-self-end">
                                <p class="font-medium text-sm leading-4 text-white">Price</p>
                                <p class="font-semibold text-lg text-white">{{ toRupiah(item.price) }}</p>
                            </div>
                        </MemberCard>
                    </div>
                </div>
            </div>
            <!-- Member list -->
            <div class="mt-10 mx-auto max-w-7xl">
                <TableList :head="head" :data="members.data" url="member.edit">
                    <div class="flex justify-end mb-5">
                        <ButtonLink :href="route('member.create')" text="Add Member" />
                    </div>
                    <template #pagination>
                        <Pagination :links="members.links" />
                    </template>
                </TableList>
            </div>
        </div>
        <Teleport to="body">
            <Modal :show="showModal" @close="closeForm" @postForm="saveFormType" :form="true">
                <h3 class="mb-6 font-bold text-center text-primary-800 text-xl">{{ form.name }} Type</h3>
                <!-- Input discount -->
                <div>
                    <InputLabel for="discount" value="Discount (decimal)" class="mb-2" />
                    <TextInput v-model="form.discount" id="discount" type="text" class="w-full" required />
                    <InputError :message="form.errors.discount" class="mt-1.5" />
                </div>
                <!-- Input price -->
                <div class="mt-3">
                    <InputLabel for="price" value="Price" class="mb-2" />
                    <TextInput v-model="form.price" id="price" type="number" class="w-full" required />
                    <InputError :message="form.errors.price" class="mt-1.5" />
                </div>
                <template #yesButton>Save</template>
                <template #noButton>Cancel</template>
            </Modal>
        </Teleport>
    </AuthenticatedLayout>
</template>

<style>
.silver-card {
    background: url('/svg/member-card-silver.svg') no-repeat;
    background-size: cover;
}

.gold-card {
    background: url('/svg/member-card-gold.svg') no-repeat;
    background-size: cover;
}

.platinum-card {
    background: url('/svg/member-card-platinum.svg') no-repeat;
    background-size: cover;
}
</style>
