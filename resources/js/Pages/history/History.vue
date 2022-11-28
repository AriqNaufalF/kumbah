<script setup>
import TableList from '@/Components/TableList.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<template>

    <Head title="Employee" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">History</h2>
            </div>
            <div class="mt-20 mx-auto max-w-7xl">
                <TableList>
                    <template #thead>
                        <th class="py-3 px-3.5">ID</th>
                        <th class="py-3 px-3.5">Customer Name</th>
                        <th class="py-3 px-3.5">Service</th>
                        <th class="py-3 px-3.5">Quantity</th>
                        <th class="py-3 px-3.5">Discount</th>
                        <th class="py-3 px-3.5">Sub Total</th>
                        <th class="py-3 px-3.5">Total Price</th>
                        <th class="py-3 px-3.5">Date</th>
                        <th class="py-3 px-3.5">Action</th>
                    </template>
                    <template #tbody>
                        <tr class="group hover:bg-slate-50">
                            <td class="py-3 px-3.5">1</td>
                            <td class="py-3 px-3.5">Agung Isra</td>
                            <td class="py-3 px-3.5">Cuci normal</td>
                            <td class="py-3 px-3.5">3.5kg</td>
                            <td class="py-3 px-3.5">-</td>
                            <td class="py-3 px-3.5">Rp17.500</td>
                            <td class="py-3 px-3.5">Rp17.500</td>
                            <td class="py-3 px-3.5">27-11-22</td>
                            <td class="py-3 px-3.5">
                                <Link :href="route('dashboard')">Details</Link>
                            </td>
                        </tr>
                    </template>
                </TableList>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
