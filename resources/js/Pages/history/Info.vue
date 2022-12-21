<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, usePage } from '@inertiajs/inertia-vue3';

const clothes = [{ cloth: 'Kaos', quantity: 1 }];
const orderDetail = usePage().props.value.orderDetail;
</script>

<template>

    <Head title="Order Info" />
    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Order Info</h2>
            </div>
            <div class="mt-10 mx-auto max-w-7xl">
                <div class="p-6 bg-white shadow-lg rounded-lg">
                    <h3 class="font-semibold text-lg">Order ID {{ orderDetail.order_id }}</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <InputLabel for="start" value="Order Date" class="mb-2" />
                            <TextInput id="start" :value="orderDetail.order_date" type="text" class="w-full" readonly />
                        </div>
                        <div>
                            <InputLabel for="end" value="Finished date" class="mb-2" />
                            <TextInput id="end" :value="orderDetail.finished_date" type="text" class="w-full"
                                readonly />
                        </div>
                    </div>

                    <h3 class="mt-3 font-semibold text-lg">Customer Info</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <!-- Input member id -->
                            <div>
                                <InputLabel for="memberId" value="Member ID" class="mb-2" />
                                <TextInput id="memberId" :value="orderDetail.member_id" type="text" class="w-full"
                                    readonly />
                            </div>
                            <!-- Input name -->
                            <div class="mt-3">
                                <InputLabel for="name" value="Name" class="mb-2" />
                                <TextInput id="name" :value="orderDetail.customer_name" type="text" class="w-full"
                                    readonly />
                            </div>
                            <!-- Input service -->
                            <div class="mt-3">
                                <div class="flex gap-3">
                                    <div class="w-full">
                                        <InputLabel for="service" value="Service" class="mb-2" />
                                        <TextInput id="service" :value="orderDetail.service_name" type="text"
                                            class="w-full" readonly />

                                    </div>
                                    <div class="ml-auto">
                                        <InputLabel for="serviceQty" value="Quantity" class="mb-2" />
                                        <TextInput id="serviceQty" :value="orderDetail.service_quantity" type="number"
                                            class="max-w-[120px] w-full" min="1" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-full flex flex-col">
                            <!-- Input sub total -->
                            <div>
                                <InputLabel for="subTotal" value="Sub Total" class="mb-2" />
                                <TextInput id="subTotal" :value="orderDetail.subtotal" type="text"
                                    class="w-full text-right" readonly />
                            </div>
                            <!-- Input discount -->
                            <div class="mt-3">
                                <InputLabel for="discount" value="Total Discount" class="mb-2" />
                                <TextInput id="discount" :value="orderDetail.discount" type="text"
                                    class="w-full text-right" readonly />
                            </div>
                            <!-- Input total price -->
                            <div class="mt-3">
                                <InputLabel for="totalPrice" value="Total Price" class="mb-2" />
                                <TextInput id="totalPrice" :value="orderDetail.total" type="text"
                                    class="w-full text-right" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col mt-3">
                        <h3 class="font-semibold text-lg">Order Detail</h3>
                        <div class="grid grid-cols-2 gap-6 mb-3"
                            v-for="(item, index) in JSON.parse(orderDetail.clothes)" :key="index">
                            <div>
                                <InputLabel :for="`cloth[${index}]`" value="Cloth type" class="mb-2" />
                                <TextInput v-model="item.cloth" :id="`cloth[${index}]`" type="text" class="w-full"
                                    readonly />
                            </div>
                            <div>
                                <InputLabel :for="`quantity[${index}]`" value="Quantity" class="mb-2" />
                                <TextInput v-model="item.quantity" :id="`quantity[${index}]`" type="number" min="1"
                                    class="max-w-[120px] w-full" readonly />
                            </div>
                        </div>
                        <div class="mt-4 ml-auto">
                            <PrimaryButton class="px-6 py-1.5">
                                Print
                            </PrimaryButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
