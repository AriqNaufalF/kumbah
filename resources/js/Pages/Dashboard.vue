<script setup>
import ButtonLink from '@/Components/ButtonLink.vue';
import Modal from '@/Components/Modal.vue';
import Pagination from '@/Components/Pagination.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { toRupiah } from "@/functions/numberFormat.js";
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';
import { CategoryScale, Chart as ChartJs, LinearScale, LineElement, PointElement, Tooltip } from "chart.js";
import { ref } from 'vue';
import { Line } from "vue-chartjs";

ChartJs.register(LineElement, PointElement, LinearScale, CategoryScale, Tooltip);

defineProps({
    ongoingOrders: {
        type: Object,
        default: null
    }
})

const todayOrder = usePage().props.value.todayOrder;
const todayIncome = toRupiah(usePage().props.value.todayIncome);
const totalEmployee = usePage().props.value.totalEmployee;
const totalMember = usePage().props.value.totalMember;

const tableHeader = [
    { key: 'id', label: 'ID' },
    { key: 'order_date', label: 'Date' },
    { key: 'name', label: 'Customer Name' },
    { key: 'service', label: 'Service' },
    { key: 'quantity', label: 'Quantity' },
    { key: 'total', label: 'Total Price' },
];

const chartOptions = {
    responsive: true,
    borderColor: '#FF6392',
    scales: {
        x: {
            title: {
                display: true,
                color: 'black',
                text: 'Month'
            },
        },
        y: {
            title: {
                display: true,
                color: 'black',
                text: 'Total Orders'
            },
        }
    }
};

const monthlyOrder = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [
        {
            label: 'Total orders',
            backgroundColor: '#FF3370',
            data: [50, 5, 10, 20, 40, 45, 15]
        }
    ]
};

const form = useForm({ id: 0 });
const showModal = ref(false);

function openModal(id) {
    form.id = id;
    showModal.value = true;
}

function finishOrder() {
    form.post(route('order.finish'), {
        onFinish() {
            form.reset();
        },
        preserveState: false,
    })
    showModal.value = false;
}
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Welcome to Kumbah</h2>
            </div>
            <div class="flex flex-col-reverse mt-10 gap-8 xl:flex-row">
                <!-- Unfinished order -->
                <section class="bg-white w-full shadow-md rounded-lg">
                    <div class="flex flex-col h-full">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="text-left font-medium uppercase border-b-[3px] border-primary-800">
                                    <tr>
                                        <th v-for="head in tableHeader" class="py-3 px-3.5">
                                            {{ head.label }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="ongoingOrders" v-for="(data, index) in ongoingOrders.data" :key="index">
                                        <td v-for="({ key }) in tableHeader" class="py-3 px-3.5">{{ data[key] }}</td>
                                        <td class="py-3 px-3.5">
                                            <SecondaryButton class="px-3 py-1.5" type="button"
                                                @click="openModal(data.id)">
                                                Finish
                                            </SecondaryButton>
                                        </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="7" class="py-3 px3.5 text-center text-slate-400">
                                            No orders to complete
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :links="ongoingOrders.links" class="mt-auto mb-3 mr-3.5" />
                    </div>
                </section>
                <section class="self-start w-full xl:max-w-xs">
                    <div class="flex flex-row-reverse justify-end gap-4 xl:flex-col">
                        <!-- amount of member & employee -->
                        <div class="w-1/3 self-start p-6 bg-white shadow-md rounded-lg xl:w-full">
                            <div class="flex items-center justify-end">
                                <div class="text-end mr-4">
                                    <p class="font-medium text-sm">Total Employee</p>
                                    <p class="font-semibold text-2xl">{{ totalEmployee }}</p>
                                </div>
                                <div class="p-2 bg-tertiary-600 text-white rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" height="25" width="25"
                                        class="fill-current">
                                        <path
                                            d="M0 36v-2.65q0-1.95 2.1-3.15T7.5 29q.65 0 1.2.025.55.025 1.1.125-.4.85-.6 1.725-.2.875-.2 1.875V36Zm12 0v-3.25q0-3.25 3.325-5.25t8.675-2q5.4 0 8.7 2 3.3 2 3.3 5.25V36Zm27 0v-3.25q0-1-.175-1.875t-.575-1.725q.55-.1 1.1-.125Q39.9 29 40.5 29q3.4 0 5.45 1.2Q48 31.4 48 33.35V36ZM7.5 27.5q-1.45 0-2.475-1.025Q4 25.45 4 24q0-1.45 1.025-2.475Q6.05 20.5 7.5 20.5q1.45 0 2.475 1.025Q11 22.55 11 24q0 1.45-1.025 2.475Q8.95 27.5 7.5 27.5Zm33 0q-1.45 0-2.475-1.025Q37 25.45 37 24q0-1.45 1.025-2.475Q39.05 20.5 40.5 20.5q1.45 0 2.475 1.025Q44 22.55 44 24q0 1.45-1.025 2.475Q41.95 27.5 40.5 27.5ZM24 24q-2.5 0-4.25-1.75T18 18q0-2.55 1.75-4.275Q21.5 12 24 12q2.55 0 4.275 1.725Q30 15.45 30 18q0 2.5-1.725 4.25T24 24Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex items-center justify-end">
                                <div class="text-end mr-4">
                                    <p class="font-medium text-sm">Total Active Member</p>
                                    <p class="font-semibold text-2xl">{{ totalMember }}</p>
                                </div>
                                <div class="p-2 bg-tertiary-600 text-white rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" height="25" width="25"
                                        class="fill-current">
                                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                        <path
                                            d="M64 32C28.7 32 0 60.7 0 96v32H576V96c0-35.3-28.7-64-64-64H64zM576 224H0V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V224zM112 352h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- Today info -->
                        <div class="w-1/3 p-6 bg-white shadow-md rounded-lg xl:w-full">
                            <h3 class="font-semibold text-lg text-center uppercase">Today</h3>
                            <div class="mt-4">
                                <div class="flex items-center justify-end">
                                    <div class="text-end mr-4">
                                        <p class="font-medium text-sm">Incoming Orders</p>
                                        <p class="font-semibold text-2xl">
                                            {{ todayOrder }}
                                        </p>
                                    </div>
                                    <div class="p-2 bg-tertiary-600 text-white rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="25"
                                            height="25"
                                            fill="currentColor"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                            <path
                                                d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48H69.5c3.8 0 7.1 2.7 7.9 6.5l51.6 271c6.5 34 36.2 58.5 70.7 58.5H488c13.3 0 24-10.7 24-24s-10.7-24-24-24H199.7c-11.5 0-21.4-8.2-23.6-19.5L170.7 288H459.2c32.6 0 61.1-21.8 69.5-53.3l41-152.3C576.6 57 557.4 32 531.1 32H360V134.1l23-23c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-64 64c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l23 23V32H120.1C111 12.8 91.6 0 69.5 0H24zM176 512a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm336-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8">
                                <div class="flex items-center justify-end">
                                    <div class="text-end mr-4">
                                        <p class="font-medium text-sm">Total Income</p>
                                        <p class="font-semibold text-2xl">{{ todayIncome }}</p>
                                    </div>
                                    <div class="p-2 bg-tertiary-600 text-white rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" height="25"
                                            width="25" fill="currentColor">
                                            <path
                                                d="M27 27q-2.5 0-4.25-1.75T21 21q0-2.5 1.75-4.25T27 15q2.5 0 4.25 1.75T33 21q0 2.5-1.75 4.25T27 27Zm-16 7q-1.25 0-2.125-.875T8 31V11q0-1.25.875-2.125T11 8h32q1.25 0 2.125.875T46 11v20q0 1.25-.875 2.125T43 34Zm5-3h22q0-2.1 1.45-3.55Q40.9 26 43 26V16q-2.1 0-3.55-1.45Q38 13.1 38 11H16q0 2.1-1.45 3.55Q13.1 16 11 16v10q2.1 0 3.55 1.45Q16 28.9 16 31Zm24 9H5q-1.25 0-2.125-.875T2 37V14h3v23h35Zm-29-9V11v20Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <ButtonLink class="block mt-4 text-center" :href="route('dashboard.order')"
                                text="Add Order" />
                        </div>
                    </div>
                </section>
            </div>
            <!-- Yearly chart -->
            <section class="mt-8 bg-white w-full shadow-md rounded-lg">
                <div class="p-6">
                    <h3 class="mb-4 font-semibold text-lg text-center uppercase">Order Statistic For The Year</h3>
                    <Line class="max-h-96" :data="monthlyOrder" :options="chartOptions" />
                </div>
            </section>
        </div>
        <Teleport to="body">
            <Modal :show="showModal" @close="showModal = false" @postForm="finishOrder">
                <svg xmlns=" http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" viewBox="0 0 16 16"
                    class="mx-auto mb-4 fill-slate-600">
                    <path
                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z" />
                </svg>
                <h3 class="mb-5 text-lg">Are you sure want to finish this order?</h3>
            </Modal>
        </Teleport>
    </AuthenticatedLayout>
</template>
