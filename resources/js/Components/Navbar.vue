<template>
    <nav
        aria-label="secondary"
        :class="[
            'sticky top-0 z-10 px-6 py-4 bg-white flex items-center justify-between transition-transform duration-500 dark:bg-dark-eval-1',
            {
                '-translate-y-full': scrolling.down,
                'translate-y-0': scrolling.up,
            },
        ]"
    >
        <div class="flex items-center gap-2">
            <Button
                iconOnly
                variant="secondary"
                type="button"
                @click="toggleDarkMode"
                v-slot="{ iconSizeClasses }"
                class="md:hidden"
                srText="Toggle dark mode"
            >
                <MoonIcon
                    v-show="!isDark"
                    aria-hidden="true"
                    :class="iconSizeClasses"
                />
                <SunIcon
                    v-show="isDark"
                    aria-hidden="true"
                    :class="iconSizeClasses"
                />
            </Button>
        </div>
        <div class="flex items-center gap-2">
            <Button
                iconOnly
                variant="secondary"
                type="button"
                @click="toggleDarkMode"
                v-slot="{ iconSizeClasses }"
                class="hidden md:inline-flex"
                srText="Toggle dark mode"
            >
                <MoonIcon
                    v-show="!isDark"
                    aria-hidden="true"
                    :class="iconSizeClasses"
                />
                <SunIcon
                    v-show="isDark"
                    aria-hidden="true"
                    :class="iconSizeClasses"
                />
            </Button>

            <Button
                iconOnly
                variant="secondary"
                type="button"
                @click="toggleFullScreen"
                v-slot="{ iconSizeClasses }"
                class="hidden md:inline-flex"
                srText="Toggle dark mode"
            >
                <ArrowsExpandIcon
                    v-show="!isFullscreen"
                    aria-hidden="true"
                    :class="iconSizeClasses"
                />
                <ArrowsInnerIcon
                    v-show="isFullscreen"
                    aria-hidden="true"
                    :class="iconSizeClasses"
                />
            </Button>

            <Link :href="route('notifications')" class="pl-3" v-if="$page.props.permission.users.viewAny">
                <span id="js-count" v-if="unreadNotifications > 0" class="absolute px-2 py-1 ml-2 text-xs text-white bg-red-600 rounded-full bottom-9">
                        {{ unreadNotifications }}
                </span>


                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                </svg>


            </Link>

            <!-- Dropdwon -->
            <BreezeDropdown align="right" width="48">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <button
                            type="button"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 dark:focus:ring-offset-dark-eval-1 dark:bg-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200"
                        >
                            {{ $page.props.auth.user.name }}

                            <svg
                                class="ml-2 -mr-0.5 h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </span>
                </template>
                <template #content>
                    <BreezeDropdownLink
                        :href="route('logout')"
                        method="post"
                        as="button"
                    >
                        Se déconnecter
                    </BreezeDropdownLink>
                </template>
            </BreezeDropdown>
        </div>
    </nav>

    <!-- Mobile bottom bar -->
    <div
        :class="[
            'fixed inset-x-0 bottom-0 flex items-center justify-between px-4 py-4 sm:px-6 transition-transform duration-500 bg-white md:hidden dark:bg-dark-eval-1',
            {
                'translate-y-full': scrolling.down,
                'translate-y-0': scrolling.up,
            },
        ]"
    >
        <Button
            iconOnly
            variant="secondary"
            type="button"
            v-slot="{ iconSizeClasses }"
            srText="Search"
        >
            <SearchIcon aria-hidden="true" :class="iconSizeClasses" />
        </Button>

        <Link :href="route('dashboard')">
            <ApplicationLogo class="w-10 h-10" />
            <span class="sr-only">K UI</span>
        </Link>

        <Button
            iconOnly
            variant="secondary"
            type="button"
            @click="sidebarState.isOpen = !sidebarState.isOpen"
            v-slot="{ iconSizeClasses }"
            class="md:hidden"
            srText="Search"
        >
            <MenuIcon
                v-show="!sidebarState.isOpen"
                aria-hidden="true"
                :class="iconSizeClasses"
            />
            <XIcon
                v-show="sidebarState.isOpen"
                aria-hidden="true"
                :class="iconSizeClasses"
            />
        </Button>
    </div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import { useFullscreen } from '@vueuse/core'
import {
    SunIcon,
    MoonIcon,
    SearchIcon,
    MenuIcon,
    XIcon,
    ArrowsExpandIcon
} from '@heroicons/vue/outline'
import {
    handleScroll,
    isDark,
    scrolling,
    toggleDarkMode,
    sidebarState,
} from '@/Composables'
import Button from '@/Components/Button'
import ApplicationLogo from '@/Components/ApplicationLogo'
import BreezeDropdown from '@/Components/Dropdown'
import BreezeDropdownLink from '@/Components/DropdownLink'
import { ArrowsInnerIcon } from '@/Components/Icons/outline'

const { isFullscreen, toggle: toggleFullScreen } = useFullscreen()

onMounted(() => {
    document.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    document.removeEventListener('scroll', handleScroll)
})
</script>

<script>

export default {

      created(){
        window.Echo.private(`App.Models.User.${this.$page.props.permission.users.id}`)
            .notification((notification) => {
            console.log(notification);
            /* switch(notification.type) {
                case 'App\\Notifications\\FactureImport':
                    this.$page.props.permission.users.unreadNotificationsCount++
                break;
            } */

        });
    },

    data(){
        return {
            unreadNotifications: this.$page.props.permission.users.unreadNotifications,
        }
    },


}
</script>
