<script setup>
import { CategoryScale, Chart as ChartJs, LinearScale, LineElement, PointElement, Tooltip } from "chart.js";
import { Line } from "vue-chartjs";


const props = defineProps({
    yAxisTitle: {
        type: String,
        required: true
    },
    data: {
        type: Array,
        required: true
    }
})

ChartJs.register(LineElement, PointElement, LinearScale, CategoryScale, Tooltip);

const monthLabels = {
    1: 'Jan',
    2: 'Feb',
    3: 'Mar',
    4: 'Apr',
    5: 'May',
    6: 'Jun',
    7: 'Jul',
    8: 'Aug',
    9: 'Sep',
    10: 'Oct',
    11: 'Nov',
    12: 'Dec'
};
function getDataPerMonth() {
    // insert a default value as 0 every month
    let monthlyData = new Array(12).fill(0);
    // replace 0 to a data from db if available
    props.data.forEach(obj => {
        monthlyData.splice(obj.month - 1, 1, obj.data)
    })

    return monthlyData;
}

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
                text: props.yAxisTitle
            },
            ticks: {
                precision: 0
            }
        }
    }
};

const chartData = {
    labels: Object.values(monthLabels),
    datasets: [
        {
            label: props.yAxisTitle,
            backgroundColor: '#FF3370',
            data: getDataPerMonth()
        }
    ]
};
</script>

<template>
    <section class="mt-8 mx-auto bg-white w-full max-w-7xl shadow-md rounded-lg">
        <div class="p-6">
            <slot />
            <Line class="max-h-96" :data="chartData" :options="chartOptions" />
        </div>
    </section>
</template>
