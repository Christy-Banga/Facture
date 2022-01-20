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

                            <div class="flex p-1">
                                <button type="submit" class="p-2 bg-blue-600 dark:bg-gray-700 text-white hover:bg-blue-800 dark:hover:bg-gray-900 rounded">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated'
import Button from '@/Components/Button'
import { GithubIcon } from '@/Components/Icons/brands'
import { Link, useForm } from '@inertiajs/inertia-vue3'
import GuestLayout from '@/Layouts/Guest'
import Input from '@/Components/Input'
import Label from '@/Components/Label'
import ValidationErrors from '@/Components/ValidationErrors'

    const form = useForm({
        name: '',
        email: '',
        password: ''
    })

    const submit = () => {
        form.post('/gestionnaire'), {
    }
}

</script>

