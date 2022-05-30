<template>
    <AuthenticatedLayout title="Catégorie">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Catégorie
                </h2>
            </div>
        </template>

        <div class="py-2" v-if="$page.props.flash.success">
            <div v-if="$page.props.flash.success"  class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                <span class="block sm:inline">{{ $page.props.flash.success }}</span>
            </div>
        </div>

        <div class="py-2" v-if="$page.props.flash.warning">
            <div v-if="$page.props.flash.warning"  class="relative px-4 py-3 text-yellow-700 bg-yellow-100 border border-yellow-400 rounded" role="alert">
                <span class="block sm:inline">{{ $page.props.flash.warning }}</span>
            </div>
        </div>

         <div class="py-2">
            <div v-if="$page.props.flash.danger"  class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                <span class="block sm:inline">{{ $page.props.flash.danger }}</span>
            </div>
        </div>

          <div class="p-5 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-800">
                <form  @submit.prevent="submit">

                    <div class="mb-4">
                        <label class="text-xl text-gray-600 dark:text-white">Name <span class="text-red-500">*</span></label>
                        <input type="text" v-model="form.name" class="w-full p-2 border-2 border-gray-300 dark:bg-gray-700 dark:border-gray-800" name="name" id="name">
                        <div class="py-2 my-1 text-red-500 bg-red-200" v-if="form.errors.name">{{ form.errors.name }}</div>
                    </div>

                    <div class="flex p-1">
                        <button type="submit" class="p-2 text-white bg-gray-500 rounded hover:bg-gray-400" required>Submit</button>
                    </div>
                </form>
            </div>

            <div class="py-3">
                <div class="overflow-auto rounded-lg shadow">
                    <table class="w-full">
                        <thead class="border-b-2 border-gray-200 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-700">
                            <tr>
                                <th class="p-2 text-sm font-semibold tracking-wide text-left">
                                    <span class="inline-flex justify-between w-full">Name
                                        <!-- <svg v-if="params.field === 'numero_facture' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                        </svg>
                                        <svg v-if="params.field === 'numero_facture' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                        </svg> -->
                                    </span>
                                </th>

                                <th v-if="$page.props.permission.users.create">Actions</th>
                            </tr>
                        </thead>

                        <tbody v-for="tag in tags" :key="tag.id" class="divide-y divide-gray-100">
                            <tr class="bg-white dark:bg-gray-800">
                                <td class="p-2 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{tag.name}}</td>

                                <td v-if="$page.props.permission.users.create" class="px-6 py-2 text-center">
                                    <div class="flex justify-center item-center">
                                        <Link :href="route('categorie.edit', tag.id)" class="w-4 mr-2 text-purple-900 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="dark:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </Link>
                                        <Link  @click="destroy(tag.id)" class="w-4 mr-2 text-red-600 transform hover:text-red-400 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>



    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated'
import { Link, useForm } from '@inertiajs/inertia-vue3'


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


