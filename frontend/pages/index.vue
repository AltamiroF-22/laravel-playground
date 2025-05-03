<template>
    <div class="w-full max-w-7xl mx-auto px-4 py-8">
        <!-- Filtros e gráfico -->
        <div class="flex flex-col md:flex-row gap-6 mb-8 md:items-center">
            <UiRangeCalendar
                v-model="value"
                class="rounded-md border max-w-[255px]"
            />
            <ChartArea />
        </div>

        <!-- Título e descrição -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-neutral-900">
                Nova movimentação
            </h2>
            <p class="text-gray-500 text-sm mt-1">
                Preencha os campos abaixo para adicionar uma receita, despesa ou
                investimento.
            </p>
        </div>

        <!-- Formulário -->
        <div class="grid center grid-cols-1 md:grid-cols-2 gap-6">
            <div class="w-full flex items-center">
                <UiCalendar
                    v-model="calendar"
                    class="w-full max-w-[255px] rounded-md border bg-white shadow-sm"
                />
            </div>

            <div class="flex flex-col gap-4 md:gap-6">
                <div>
                    <UiLabel for="amount">Total</UiLabel>
                    <UiInput
                        id="amount"
                        v-model="form.amount"
                        type="number"
                        class="mt-1"
                    />
                </div>

                <div>
                    <UiLabel for="description">Descrição</UiLabel>
                    <UiTextarea
                        v-model="form.description"
                        id="description"
                        placeholder="Adicione uma descrição (opcional)"
                        class="mt-1"
                    />
                </div>

                <div>
                    <UiLabel for="category">Categoria</UiLabel>
                    <UiSelect v-model="form.category_id">
                        <UiSelectTrigger class="w-full mt-1">
                            <UiSelectValue
                                placeholder="Selecione uma categoria"
                            />
                        </UiSelectTrigger>
                        <UiSelectContent>
                            <UiSelectGroup>
                                <UiSelectLabel>Categorias</UiSelectLabel>
                                <UiSelectItem :value="1">Receita</UiSelectItem>
                                <UiSelectItem :value="2">Despesa</UiSelectItem>
                                <UiSelectItem :value="3"
                                    >Investimento</UiSelectItem
                                >
                                <UiSelectItem :value="4">Outros</UiSelectItem>
                            </UiSelectGroup>
                        </UiSelectContent>
                    </UiSelect>
                </div>

                <!-- Botão de submissão -->
                <div class="mt-6">
                    <UiButton @click="handleSubmit">
                        Adicionar movimentação
                    </UiButton>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { parseDate, today, getLocalTimeZone } from "@internationalized/date";
import { usePageTitle } from "@/composables/usePageTitle";

// Título da página
const pageTitle = usePageTitle();
pageTitle.value = "Minhas Movimentações | Dashboard";

// Acesso ao store
const { form, params } = useAmountMovimentation();
const store = useAmountMovimentation();

// Inicializa a data com string no formato "YYYY-MM-DD"
form.date = form.date;

// Computed para sincronizar <UiCalendar> com form.date
const calendar = computed({
    get: () => parseDate(form.date), // converte string → CalendarDate
    set: (val) => {
        form.date = val.toString(); // converte CalendarDate → string
    },
});

// Para o RangeCalendar (manter como está)
const value = ref({
    start: parseDate(params.start_date),
    end: parseDate(params.end_date),
});

watch(value, (newValue) => {
    params.start_date = newValue.start.toString();
    params.end_date = newValue.end.toString();
    store.fetchMonthlyCategoryData();
});

// Função de envio
const handleSubmit = () => {
    // Lógica para adicionar a movimentação
    console.log("Movimentação adicionada", form);
};
</script>
