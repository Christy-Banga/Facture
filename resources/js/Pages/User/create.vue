<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                   Gestionnaire > Add new
                </h2>
            </div>
        </template>

        <!-- component -->
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-800">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label for="name" class="text-xl text-gray-600 dark:text-white">Name <span class="text-red-500">*</span></label>
                                <input type="text" v-model="form.name" class="border-2 border-gray-300 p-2 w-full dark:border-gray-700 dark:bg-gray-900" id="name">
                                <div class="bg-red-200 py-2 my-1 text-red-500" v-if="form.errors.name">{{ form.errors.name }}</div>
                            </div>

                            <div class="mb-4">
                                <label class="text-xl text-gray-600 dark:text-white">Email <span class="text-red-500">*</span></label>
                                <input type="email" v-model="form.email" class="border-2 border-gray-300 p-2 w-full dark:border-gray-700 dark:bg-gray-900"  id="email">
                                <div class="bg-red-200 py-2 my-1 text-red-500" v-if="form.errors.email">{{ form.errors.email }}</div>
                            </div>

                            <div class="mb-4">
                                <label class="text-xl text-gray-600 dark:text-white">Password <span class="text-red-500">*</span></label>
                                <input type="password" v-model="form.password" class="border-2 border-gray-300 p-2 w-full dark:border-gray-700 dark:bg-gray-900" id="password">
                                <div class="bg-red-200 py-2 my-1 text-red-500" v-if="form.errors.password">{{ form.errors.password }}</div>
                            </div>

                            <div class="flex items-stretch">
                                <div class="flex p-1">
                                    <Link :href="route('gestionnaire.index')" type="submit" class="text-white p-2 bg-purple-600 hover:bg-purple-800 dark:bg-purple-700 dark:hover:bg-purple-800 px-3 py-2 float-right rounded">Retour</Link>
                                </div>
                                <div class="flex p-1">
                                    <button type="submit" class="text-white p-2 bg-blue-600 hover:bg-blue-800 dark:bg-gray-700 dark:hover:bg-gray-800 px-3 py-2 float-right rounded">
                                            <svg v-show="isLoading" class="w-5 h-5 text-white animate-spin absolute ml-4" fill="none"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                                    fill="currentColor">
                                                </path>
                                            </svg>

                                        <span :class="{'invisible': isLoading}">Ajouter</span>
                                        </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import {ref} from 'vue';
const isLoading = ref(false);


import AuthenticatedLayout from '@/Layouts/Authenticated'
import { Link, useForm } from '@inertiajs/inertia-vue3'

    const form = useForm({
        name: '',
        email: '',
        password: ''
    })

    const submit = () => {
         isLoading.value = true;
    setTimeout(() => isLoading.value = false,500);
        form.post('/gestionnaire'), {
    }
}

</script>

