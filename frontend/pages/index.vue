<template>
    <div class="w-full mx-auto max-w-[1920px]">
        <div class="border mt-10">
            <h1 class="text-center pt-5">Minhas Movimentações</h1>
            <ChartArea />
        </div>
    </div>
</template>

<script setup lang="ts">
import { usePageTitle } from "@/composables/usePageTitle";

const pageTitle = usePageTitle();
pageTitle.value = "Minhas Movimentações | Dashboard";

// exemplo para mudar o title na mesma rota 
// if (tabelaSelecionada.value === 'investimentos') {
//   pageTitle.value = 'Dashboard de Investimentos'
// }

</script>
