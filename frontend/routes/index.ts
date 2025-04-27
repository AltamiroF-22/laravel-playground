// router/index.ts
import { createRouter, createWebHistory } from "vue-router";
import HomePage from "@/pages/index.vue";
// import RelatoriosPage from "@/pages/Relatorios.vue";
// …

export const routes = [
    {
        path: "/",
        component: HomePage,
        meta: { title: "Página Inicial" },
    },
    // {
    //     path: "/relatorios",
    //     component: RelatoriosPage,
    //     meta: { title: "Relatórios Financeiros" },
    // },
    // … outras rotas
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
