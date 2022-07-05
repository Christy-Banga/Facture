<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                   Catégorie > Modifier
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


                            <div class="flex items-stretch">
                                <div class="flex p-1">
                                    <Link :href="route('categorie.index')" class="float-right p-2 px-3 py-2 text-white bg-purple-600 rounded hover:bg-purple-800 dark:bg-purple-700 dark:hover:bg-purple-800">Retour</Link>
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
    cat: Object,
    Link: Object
})

    const form = useForm({
        _method: 'PUT',
        name: props.cat.name,
    })

    const submit = () => {

        form.post(route('categorie.update',props.cat.id), {
                preserveScroll: true,
            });
        };


</script>

