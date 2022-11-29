<script setup>
import TableList from '@/Components/TableList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

const head = [
    { key: 'id', label: 'ID', sortable: true },
    { key: 'name', label: 'Customer Name', sortable: true },
    { key: 'service', label: 'Service', sortable: true },
    { key: 'quantity', label: 'Quantity', sortable: true },
    { key: 'discount', label: 'Discount', sortable: true },
    { key: 'subTotal', label: 'Sub Total', sortable: true },
    { key: 'totalPrice', label: 'Total Price', sortable: true },
    { key: 'date', label: 'Date', sortable: true },
];

const historyData = [
    { id: 1, name: 'Agung Isra', service: 'Cuci normal', quantity: '3.5kg', discount: '-', subTotal: 'Rp17.500', totalPrice: 'Rp17.500', date: '27-11-22' }
]
</script>

<template>

    <Head title="Employee" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">History</h2>
            </div>
            <div class="mt-20 mx-auto max-w-7xl">
                <TableList :head="head" :data="historyData" action="details" url="dashboard" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
