<template>
    <UiSidebar
        class="overflow-hidden *:data-[sidebar=sidebar]:flex-row"
        v-bind="props"
    >
        <!-- Sidebar de ícones -->
        <UiSidebar
            collapsible="none"
            class="w-[calc(var(--sidebar-width-icon)+1px)]! border-r"
        >
            <UiSidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton
                            size="lg"
                            as-child
                            class="md:h-8 md:p-0"
                        >
                            <a href="#" class="flex gap-3 border-b pb-4">
                                <div
                                    class="flex aspect-square size-8 items-center justify-center rounded-lg bg-primary text-sidebar-primary-foreground"
                                >
                                    <TrendingUp class="size-4" />
                                </div>
                                <div
                                    class="grid flex-1 text-left text-sm leading-tight"
                                >
                                    <span class="truncate font-semibold"
                                        >Acme Inc</span
                                    >
                                    <span class="truncate text-xs"
                                        >Enterprise</span
                                    >
                                </div>
                            </a>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </UiSidebarHeader>

            <UiSidebarContent>
                <UiSidebarGroup>
                    <UiSidebarGroupContent
                        class="px-1.5 hidden md:px-0 md:block"
                    >
                        <UiSidebarMenu>
                            <UiSidebarMenuItem
                                v-for="item in data"
                                :key="item.title"
                            >
                                <UiSidebarMenuButton
                                    :is-active="activeItem.title === item.title"
                                    class="px-2.5 md:px-2"
                                    @click="setActiveItem(item), setOpen(true)"
                                >
                                    <component :is="item.icon" />
                                    <span>{{ item.title }}</span>
                                </UiSidebarMenuButton>
                            </UiSidebarMenuItem>
                        </UiSidebarMenu>
                    </UiSidebarGroupContent>

                    <!-- SUBMENU MOBILE (ACCORDION) -->
                    <UiSidebar collapsible="none" class="flex md:hidden flex-1">
                        <UiSidebarContent>
                            <UiAccordion
                                type="single"
                                collapsible
                                class="w-full"
                                :default-value="activeItem.title"
                            >
                                <UiAccordionItem
                                    v-for="item in data"
                                    :key="item.title"
                                    :value="item.title"
                                >
                                    <UiAccordionTrigger
                                        class="flex items-center justify-between px-4 py-3"
                                        @click="
                                            setActiveItem(item), setOpen(true)
                                        "
                                    >
                                        <div class="flex items-center gap-2">
                                            <component
                                                :is="item.icon"
                                                class="size-4"
                                            />
                                            <span>{{ item.title }}</span>
                                        </div>
                                    </UiAccordionTrigger>
                                    <UiAccordionContent class="px-4 py-2">
                                        <a
                                            v-for="sub in item.subUrls"
                                            :key="sub.label"
                                            :href="sub.href"
                                            class="flex items-center gap-2 py-2 hover:bg-sidebar-accent hover:text-sidebar-accent-foreground rounded"
                                        >
                                            <component
                                                :is="sub.icon"
                                                class="size-4"
                                            />
                                            <span>{{ sub.label }}</span>
                                        </a>
                                    </UiAccordionContent>
                                </UiAccordionItem>
                            </UiAccordion>
                        </UiSidebarContent>
                    </UiSidebar>
                </UiSidebarGroup>
            </UiSidebarContent>
        </UiSidebar>

        <!-- Sidebar de sub-itens -->
        <UiSidebar collapsible="none" class="hidden flex-1 md:flex">
            <div class="hidden md:flex w-full px-2 pb-2 pt-3">
                <p class="text-primary font-bold text-2xl">
                    CashWise 
                </p>
            </div>
            <UiSidebarContent>
                <UiSidebarGroup class="px-0">
                    <UiSidebarGroupContent>
                        <a
                            v-for="sub in subUrls"
                            :key="sub.label"
                            :href="sub.href"
                            class="hover:bg-sidebar-accent hover:text-sidebar-accent-foreground flex flex-col items-start border-b px-4 py-5 text-sm first:border-t"
                        >
                            <div class="flex w-full items-center gap-2">
                                <component :is="sub.icon" class="size-4" />
                                <span>{{ sub.label }}</span>
                            </div>
                        </a>
                    </UiSidebarGroupContent>
                </UiSidebarGroup>
            </UiSidebarContent>
        </UiSidebar>
    </UiSidebar>
</template>

<script setup lang="ts">
import {
    Home,
    BarChart2,
    PieChart,
    FileText,
    CreditCard,
    DollarSign,
    TrendingUp,
    Users,
    Calendar,
    Bell,
    Settings,
    Inbox,
    Send,
    ArchiveX,
    Trash2,
} from "lucide-vue-next";

import { useSidebar, type SidebarProps } from "./ui/sidebar";

interface SubUrl {
    label: string;
    icon: Component;
    href: string;
}

interface NavItem {
    title: string;
    url: string;
    icon: Component;
    subUrls: SubUrl[];
}

const props = withDefaults(defineProps<SidebarProps>(), {
    collapsible: "icon",
});

const data = ref<NavItem[]>([
    {
        title: "Dashboard",
        url: "#",
        icon: Home,
        subUrls: [
            { label: "Visão Geral", icon: BarChart2, href: "#" },
            { label: "Receitas x Despesas", icon: PieChart, href: "#" },
            { label: "Tendências", icon: TrendingUp, href: "#" },
        ],
    },
    {
        title: "Contas",
        url: "#",
        icon: CreditCard,
        subUrls: [
            { label: "Cartões", icon: CreditCard, href: "#" },
            { label: "Contas Bancárias", icon: DollarSign, href: "#" },
            { label: "Adicionar Conta", icon: FileText, href: "#" },
        ],
    },
    {
        title: "Transações",
        url: "#",
        icon: FileText,
        subUrls: [
            { label: "Todas", icon: FileText, href: "#" },
            { label: "Recebidas", icon: Inbox, href: "#" },
            { label: "Enviadas", icon: Send, href: "#" },
            { label: "Canceladas", icon: ArchiveX, href: "#" },
            { label: "Lixo", icon: Trash2, href: "#" },
        ],
    },
    {
        title: "Relatórios",
        url: "#",
        icon: BarChart2,
        subUrls: [
            { label: "Mensais", icon: BarChart2, href: "#" },
            { label: "Anuais", icon: Calendar, href: "#" },
            { label: "Customizados", icon: PieChart, href: "#" },
        ],
    },
    {
        title: "Usuários",
        url: "#",
        icon: Users,
        subUrls: [
            { label: "Lista de Usuários", icon: Users, href: "#" },
            { label: "Permissões", icon: Settings, href: "#" },
            { label: "Adicionar Usuário", icon: Users, href: "#" },
        ],
    },
    {
        title: "Notificações",
        url: "#",
        icon: Bell,
        subUrls: [
            { label: "Todas", icon: Bell, href: "#" },
            { label: "Não Lidas", icon: Bell, href: "#" },
            { label: "Configurar", icon: Settings, href: "#" },
        ],
    },
    {
        title: "Configurações",
        url: "#",
        icon: Settings,
        subUrls: [
            { label: "Perfil", icon: Users, href: "#" },
            { label: "Conta", icon: Settings, href: "#" },
            { label: "Ajuda", icon: Bell, href: "#" },
        ],
    },
]);

const activeItem = ref<NavItem>(data.value[0]);
const subUrls = computed(() => activeItem.value.subUrls);
const { setOpen } = useSidebar();

function setActiveItem(item: NavItem) {
    activeItem.value = item;
}
</script>
