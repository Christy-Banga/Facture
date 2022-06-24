<template>
    <AuthenticatedLayout title="Catégorie">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Catégorie
                </h2>
            </div>
        </template>

          <div class="p-5 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-800">
                <form  @submit.prevent="submit">

                    <div class="mb-4">
                        <label class="text-xl text-gray-600 dark:text-white">Name <span class="text-red-500">*</span></label>
                        <input type="text" v-model="form.name" class="w-full p-2 border-2 border-gray-300 dark:bg-gray-700 dark:border-gray-800" name="name" id="name">
                        <div class="py-2 my-1 text-red-500 bg-red-200" v-if="form.errors.name">{{ form.errors.name }}</div>
                    </div>

                    <div class="flex p-1">
                        <button type="submit" class="p-2 text-white bg-gray-500 rounded hover:bg-gray-400" required>Ajouter</button>
                    </div>
                </form>
            </div>


    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated'
import { Link, useForm } from '@inertiajs/inertia-vue3'

 import {ref,onMounted} from "vue"

  const form = useForm({
        name: ''
    })

      const submit = () => {
       /*  isLoading.value = true;
        setTimeout(() => isLoading.value = false,1000); */
        form.post('/categorie'), {
        }
    }

</script>

<script>
    export default {
        props:['tags'],

         methods: {
            destroy(id) {
                if(confirm('Voulez-vous vraiment supprimé cette catégorie?'))
                this.$inertia.delete(route("categorie.destroy", id));
            },
        }
    }
</script>


