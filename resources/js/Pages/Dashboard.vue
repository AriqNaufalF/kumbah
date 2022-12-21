<script setup>
import ButtonLink from '@/Components/ButtonLink.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { CategoryScale, Chart as ChartJs, LinearScale, LineElement, PointElement, Tooltip } from "chart.js";
import { Line } from "vue-chartjs";

ChartJs.register(LineElement, PointElement, LinearScale, CategoryScale, Tooltip);

const daysInMonth = 31
function printAllDays() {
    let days = [];
    for (let i = 1; i <= daysInMonth; i++) {
        days.push(i);
    }
    return days;
}

const chartOptions = {
    responsive: true,
    borderColor: '#FF6392',
    scales: {
        x: {
            title: {
                display: true,
                color: 'black',
                text: 'Days'
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
    labels: printAllDays(),
    datasets: [
        {
            label: 'Total orders',
            backgroundColor: '#FF3370',
            data: [50, 5, 10, 20, 40, 45, 15]
        }
    ]
};

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-10 px-6 mx-auto">
            <div class="text-center">
                <h2 class="font-bold text-primary-800 text-2xl uppercase xl:text-3xl">Welcome to Kumbah</h2>
            </div>
            <div class="flex flex-col mt-10 gap-12 xl:flex-row">
                <!-- Today info -->
                <section class="self-start bg-white w-full max-w-md xl:max-w-xs shadow-md rounded-lg">
                    <div class="flex flex-col h-full p-6">
                        <h3 class="font-semibold text-lg text-center uppercase">Today</h3>
                        <div class="mt-4">
                            <p class="font-medium text-sm">Incoming Orders</p>
                            <p class="font-semibold text-2xl">15</p>
                        </div>
                        <div class="mt-8">
                            <p class="font-medium text-sm">Total Income</p>
                            <p class="font-semibold text-2xl">Rp 29.000</p>
                        </div>
                        <ButtonLink class="mt-4 text-center" :href="route('dashboard.order')" text="Add Order" />
                    </div>
                </section>
                <!-- monthly chart -->
                <section class="bg-white w-full shadow-md rounded-lg">
                    <div class="p-6">
                        <h3 class="mb-4 font-semibold text-lg text-center uppercase">Order Statistic For The Month</h3>
                        <Line class="max-h-96" :data="monthlyOrder" :options="chartOptions" />
                    </div>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
