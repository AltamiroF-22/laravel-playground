import { defineStore } from "pinia";
import { ref, computed } from "vue";
import axios from "axios";
import { useAuth } from "@/stores/AuthStore";

export interface Category {
    id: number;
    name: string;
}

export interface MonthlyCategoryData {
    month: string;
    category_id: number;
    total: number;
    category: Category;
}

export const useAmountMovimentation = defineStore("movimentation", () => {
    const auth = useAuth().token;

    const monthlyCategoryData = ref<MonthlyCategoryData[]>([]);

    const params = ref({
        start_date: "",
        end_date: "",
        category_name: "",
    });

    const chartColors = ["#7c3aed", "#38bdf8", "#34d399", "#fbbf24"];

    const months = computed(() => {
        return Array.from(
            new Set(monthlyCategoryData.value.map((item) => item.month))
        ).sort();
    });

    const fetchMonthlyCategoryData = async () => {
        try {
            const response = await axios.get(
                "http://127.0.0.1:8000/api/dashboard",
                {
                    params: params.value,

                    headers: {
                        Authorization: `Bearer ${auth}`,
                        "Content-Type": "application/json",
                    },
                }
            );

            monthlyCategoryData.value = response.data.monthlyCategoryData.map(
                (item: any) => ({
                    month: item.month,
                    category_id: item.category_id,
                    total: parseFloat(item.total),
                    category: item.category,
                })
            );
        } catch (error) {
            console.error("Erro ao buscar os dados do dashboard:", error);
        }
    };

    return {
        monthlyCategoryData,
        chartColors,
        months,
        fetchMonthlyCategoryData,
        params,
    };
});
