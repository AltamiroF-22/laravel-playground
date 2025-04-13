/// <reference types="@pinia/nuxt" />
import tailwindcss from "@tailwindcss/vite";

export default defineNuxtConfig({
    css: ["~/assets/css/tailwind.css"],
    devtools: { enabled: true },

    modules: [
        "@nuxt/content",
        "@nuxt/image",
        "@nuxt/icon",
        "@nuxt/scripts",
        "@nuxt/fonts",
        "@pinia/nuxt",
        "pinia-plugin-persistedstate/nuxt",
        "shadcn-nuxt",
    ],

    vite: {
        plugins: [tailwindcss()],
    },

    compatibilityDate: "2025-04-12",
});
