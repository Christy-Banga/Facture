<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                   Gestionnaire > Modifier
                </h2>
            </div>
        </template>

        <!-- component -->
        <div class="py-2">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-800">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label for="name" class="text-xl text-gray-600 dark:text-white">Name <span class="text-red-500">*</span></label>
                                <input type="text" v-model="form.name" class="w-full p-2 border-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900" id="name">
                                <div class="py-2 my-1 text-red-500 bg-red-200" v-if="form.errors.name">{{ form.errors.name }}</div>

                            </div>

                            <div class="mb-4">
                                <label class="text-xl text-gray-600 dark:text-white">Email <span class="text-red-500">*</span></label>
                                <input type="email" v-model="form.email" class="w-full p-2 border-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900"  id="email">
                                <div class="py-2 my-1 text-red-500 bg-red-200" v-if="form.errors.email">{{ form.errors.email }}</div>

                            </div>

                            <div class="mb-4">
                                <label class="text-xl text-gray-600 dark:text-white">Password <span class="text-red-500">*</span></label>
                                <input type="password" v-model="form.password" class="w-full p-2 border-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900"  id="password">
                                <div class="py-2 my-1 text-red-500 bg-red-200" v-if="form.errors.password">{{ form.errors.password }}</div>

                            </div>

                            <!-- <div class="mb-4">
                                <label class="text-xl text-gray-600">Role <span class="text-red-500">*</span></label>
                                <input type="text" v-model="form.role" class="w-full p-2 border-2 border-gray-300" id="role">
                                <div class="py-2 my-1 text-red-500 bg-red-200" v-if="form.errors.role">{{ form.errors.role }}</div>
                            </div> -->

                            <div class="flex items-stretch">
                                <div class="flex p-1">
                                    <Link :href="route('gestionnaire.index')" type="submit" class="float-right p-2 px-3 py-2 text-white bg-purple-600 rounded hover:bg-purple-800 dark:bg-purple-700 dark:hover:bg-purple-800">Retour</Link>
                                </div>
                                <div class="flex p-1">
                                    <button type="submit" class="p-2 text-white transition duration-200 ease-in bg-blue-600 rounded shadow hover:bg-blue-700 active:shadow-lg mouse focus:outline-none">Modifier</button>
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
import AuthenticatedLayout from '@/Layouts/Authenticated'
import { Link, useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
    profile: Object,
    Link: Object
})

    const form = useForm({
        _method: 'PUT',
        name: props.profile.name,
        email: props.profile.email,
        password: props.profile.password,
        role: props.profile.role
    })

    const submit = () => {

        form.post(route('gestionnaire.update',props.profile.id), {
                preserveScroll: true,
            });
        };


</script>

