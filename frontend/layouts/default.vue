<template>
    <UiSidebarProvider :style="{ '--sidebar-width': '350px' }">
        <AppSidebar />
        <UiSidebarInset>
            <header
                class="sticky top-0 flex shrink-0 items-center gap-2 border-b bg-background p-4 mx-2"
            >
                <UiSidebarTrigger class="-ml-1" />
                <UiSeparator orientation="vertical" class="mr-2 h-4" />
                <UiBreadcrumb>
                    <h1 class="font-semibold text-md">{{ pageTitle }}</h1>
                </UiBreadcrumb>
            </header>
            <div class="flex flex-1 flex-col gap-4 p-4">
                <slot />
            </div>
        </UiSidebarInset>
    </UiSidebarProvider>
</template>
<script setup lang="ts">
import { computed } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const pageTitle = computed(() => (route.meta.title as string) || "All Inboxes");
</script>
