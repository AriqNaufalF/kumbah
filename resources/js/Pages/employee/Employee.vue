<script setup>
import ButtonLink from '@/Components/ButtonLink.vue';
import Pagination from '@/Components/Pagination.vue';
import TableList from '@/Components/TableList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    employees: Object
})
const head = [
    { key: 'id', label: 'ID', sortable: true, type: 'Number' },
    { key: 'name', label: 'Name', sortable: true, type: 'String' },
    { key: 'gender', label: 'Gender', sortable: true, type: 'String' },
    { key: 'address', label: 'Address', sortable: false },
    { key: 'phone', label: 'Phone Number', sortable: false },
    { key: 'email', label: 'Email', sortable: false },
];
</script>

<template>

    <Head title="Employee" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Employee List</h2>
            </div>
            <div class="mt-20 mx-auto max-w-7xl">
                <TableList :head="head" :data="employees.data" url="employee.edit">
                    <div class="flex justify-end mb-5">
                        <ButtonLink :href="route('employee.create')" text="Add Employee" />
                    </div>
                    <template #pagination>
                        <Pagination :links="employees.links" />
                    </template>
                </TableList>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
