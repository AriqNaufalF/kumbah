<script setup>
import Pagination from '@/Components/Pagination.vue';
import TableList from '@/Components/TableList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    orders: Object
})
const head = [
    { key: 'id', label: 'ID', sortable: true, type: 'Number' },
    { key: 'order_date', label: 'Date', sortable: true, type: 'String' },
    { key: 'name', label: 'Customer Name', sortable: true, type: 'String' },
    { key: 'member', label: 'Member Type', sortable: true, type: 'String' },
    { key: 'service', label: 'Service', sortable: true, type: 'String' },
    { key: 'quantity', label: 'Quantity', sortable: true, type: 'Number' },
    { key: 'total', label: 'Total Price', sortable: true, type: 'Number' },
];
</script>

<template>

    <Head title="History" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">History</h2>
            </div>
            <div class="mt-20 mx-auto max-w-7xl">
                <TableList :head="head" :data="orders.data" action="details" url="history.info">
                    <template #pagination>
                        <Pagination :links="orders.links" />
                    </template>
                </TableList>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
