<template>
    <PerfrectScrollbar
        tagname="nav"
        aria-label="main"
        class="relative flex flex-col flex-1 max-h-full gap-4 px-3 text-white"
    >
        <SidebarLink
            title="Tableau de bord" class="text-white bg-sky-700 hover:bg-sky-800 dark:hover:bg-sky-800"
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            <template #icon>
                <DashboardIcon
                    class="flex-shrink-0 w-6 h-6 text-white"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarCollapsible title="Menu">
            <SidebarCollapsibleItem :href="route('facture.index')" title="Facture" :active="route().current('facture.index')" />
            <SidebarCollapsibleItem v-if="$page.props.permission.users.viewAny" :href="route('gestionnaire.index')" title="Gestionnaire" :active="route().current('gestionnaire.index')" />
            <SidebarCollapsibleItem v-if="$page.props.permission.users.viewAny" :href="route('categorie.index')" title="Catégorie" :active="route().current('categorie.index')" />
            <SidebarCollapsibleItem :href="route('incoherence')" title="Incoherence" :active="route().current('incoherence')" />
        </SidebarCollapsible>

        <!-- Examples -->
        <!--
        => External link example
        <SidebarLink
            title="Github"
            href="https://github.com/kamona-wd/kui-laravel-breeze"
            external
            target="_blank"
        >
        </SidebarLink>

        => Collapsible examples
        <SidebarCollapsible title="Users" :active="$page.url.startsWith('/users')">
            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="$page.url === '/users/index'" />
            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="$page.url === '/users/create'" />
        </SidebarCollapsible>

        <SidebarCollapsible title="Users" :active="usePage().url.value.startsWith('/users')">
            <template #icon>
                <UserIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="route().current('users.index')" />
            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="route().current('users.create')" />
        </SidebarCollapsible> -->
    </PerfrectScrollbar>
</template>

<script setup>
import PerfrectScrollbar from '@/Components/PerfectScrollbar'
import SidebarLink from '@/Components/Sidebar/SidebarLink'
import { DashboardIcon } from '@/Components/Icons/outline'
import SidebarCollapsible from '@/Components/Sidebar/SidebarCollapsible'
import SidebarCollapsibleItem from '@/Components/Sidebar/SidebarCollapsibleItem'
</script>
