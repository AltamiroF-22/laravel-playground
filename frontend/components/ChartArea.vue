<template>
    <div class="w-full h-[300px] p-4 bg-white">
        <Line :data="chartData" :options="chartOptions" />
    </div>
</template>

<script setup lang="ts">
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    LineElement,
    CategoryScale,
    LinearScale,
    PointElement,
} from "chart.js";

import { Line } from "vue-chartjs";

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    LineElement,
    CategoryScale,
    LinearScale,
    PointElement
);

import { useAmountMovimentation } from "@/stores/AmountMoviStore";

const useAmount = useAmountMovimentation();

onMounted(() => {
    useAmount.fetchMonthlyCategoryData();
});

const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            labels: {
                color: "#333",
            },
        },
    },
    scales: {
        x: {
            ticks: { color: "#666" },
            grid: { color: "#ddd" },
        },
        y: {
            ticks: { color: "#666" },
            grid: { color: "#ddd" },
        },
    },
};

const chartData = computed(() => {
    const months = useAmount.months;
    const rawData = useAmount.monthlyCategoryData;

    // Pegar todas as categorias únicas (id => nome)
    const categoryMap = new Map<number, string>();
    rawData.forEach((item) => {
        categoryMap.set(item.category_id, item.category.name);
    });

    // Criar dataset para cada categoria
    const datasets = Array.from(categoryMap.entries()).map(
        ([id, name], index) => {
            const color =
                useAmount.chartColors[index % useAmount.chartColors.length];

            return {
                label: name,
                borderColor: color,
                backgroundColor: color,
                fill: false,
                tension: 0.4,
                data: months.map((month) => {
                    const entry = rawData.find(
                        (item) =>
                            item.month === month && item.category_id === id
                    );
                    return entry ? entry.total : 0;
                }),
            };
        }
    );

    return {
        labels: months,
        datasets,
    };
});
</script>
