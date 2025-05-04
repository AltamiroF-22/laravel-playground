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

    const currentYear = new Date().getFullYear();
    const today = new Date().toISOString().slice(0, 10);

    const params = reactive({
        start_date: `${currentYear}-01-01`,
        end_date: today,
        category_name: "",
    });

    const form = ref({
        amount: 0,
        date: today,
        category_id: 1,
        description: null,
    });

    const chartColors = ["#7c3aed", "#38bdf8", "#34d399", "#fbbf24"];

    const months = computed(() => {
        return Array.from(
            new Set(monthlyCategoryData.value.map((item) => item.month))
        ).sort();
    });

    const postMonthlyCategoryData = async () => {
        await axios.post("http://127.0.0.1:8000/api/dashboard", form.value, {
            headers: {
                Authorization: `Bearer ${auth}`,
                "Content-Type": "application/json",
            },
        });
    };

    const fetchMonthlyCategoryData = async () => {
        try {
            const response = await axios.get(
                "http://127.0.0.1:8000/api/dashboard",
                {
                    params: params,

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
        postMonthlyCategoryData,
        chartColors,
        months,
        fetchMonthlyCategoryData,
        params,
        form,
    };
});
