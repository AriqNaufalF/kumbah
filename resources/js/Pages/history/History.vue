<script setup>
import TableList from '@/Components/TableList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

const head = [
    { key: 'id', label: 'ID', sortable: true, type: 'Number' },
    { key: 'name', label: 'Customer Name', sortable: true, type: 'String' },
    { key: 'service', label: 'Service', sortable: true, type: 'String' },
    { key: 'quantity', label: 'Quantity', sortable: true, type: 'String' },
    { key: 'discount', label: 'Discount', sortable: true, type: 'String' },
    { key: 'subTotal', label: 'Sub Total', sortable: true, type: 'String' },
    { key: 'totalPrice', label: 'Total Price', sortable: true, type: 'String' },
    { key: 'date', label: 'Date', sortable: true, type: 'String' },
];

const historyData = [
    { id: 1, name: 'Agung Isra', service: 'Cuci normal', quantity: '3.5kg', discount: '-', subTotal: 'Rp17.500', totalPrice: 'Rp17.500', date: '27-11-22' }
]
</script>

<template>

    <Head title="History" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">History</h2>
            </div>
            <div class="mt-20 mx-auto max-w-7xl">
                <TableList :head="head" :data="historyData" action="details" url="history.info" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
