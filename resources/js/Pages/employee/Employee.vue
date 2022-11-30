<script setup>
import ButtonLink from '@/Components/ButtonLink.vue';
import TableList from '@/Components/TableList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

const head = [
    { key: 'id', label: 'ID', sortable: true, type: 'Number' },
    { key: 'name', label: 'Name', sortable: true, type: 'String' },
    { key: 'gender', label: 'Gender', sortable: true, type: 'String' },
    { key: 'address', label: 'Address', sortable: false },
    { key: 'phone', label: 'Phone Number', sortable: false },
    { key: 'email', label: 'Email', sortable: false },
    { key: 'job', label: 'Job', sortable: true, type: 'String' },
];

const employeeData = [
    { id: 1, name: 'Ariq Naufal', gender: 'Male', address: 'Bandung', phone: '082246791678', email: 'ariqn55@gmail.com', job: 'admin' },
    { id: 2, name: 'Wira ara-ara', gender: 'Male', address: 'Wonosobo', phone: '082224179207', email: 'wirachan@gmail.com', job: 'employee' },
    { id: 3, name: 'Agung isra', gender: 'Male', address: 'Sumatera', phone: '081277116006', email: 'agungisra@gmail.com', job: 'yutuber' },
]
</script>

<template>

    <Head title="Employee" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Employee List</h2>
            </div>
            <div class="mt-20 mx-auto max-w-7xl">
                <TableList :head="head" :data="employeeData" url="employee.edit">
                    <div class="flex justify-end mb-5">
                        <ButtonLink :href="route('employee.add')" text="Add Employee" />
                    </div>
                </TableList>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
