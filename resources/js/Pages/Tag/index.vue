<template>
    <AuthenticatedLayout title="Catégorie">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Catégorie
                </h2>

                <div>
                    <Link v-if="$page.props.permission.users.create" :href="route('categorie.create')"
                        class="w-16 h-16 p-3 transition duration-200 ease-in bg-blue-600 rounded shadow mx-14 hover:bg-blue-700 active:shadow-lg mouse focus:outline-none">
                            <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="inline-block w-6 h-6">
                                <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z" />
                            </svg>
                    </Link>
                </div>
            </div>
        </template>

            <!--  danger -->
        	<div v-if="$page.props.flash.danger" class="absolute right-0 z-10 flex flex-row items-center p-4 bg-red-200 border-b-2 border-red-300 rounded alert top-20">
                <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-red-100 border-2 border-red-500 rounded-full alert-icon">
                    <span class="text-red-500">
                        <svg fill="currentColor"
                            viewBox="0 0 20 20"
                            class="w-6 h-6">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </div>
                <div class="ml-4 alert-content">
                    <div class="text-lg font-semibold text-red-800 alert-title">
                        Danger
                    </div>
                    <div class="text-sm text-red-600 alert-description">
                        {{ $page.props.flash.danger }}
                    </div>
                </div>
		    </div>

         <!-- success -->
		<div v-if="$page.props.flash.success && showNotification" class="absolute right-0 z-10 flex flex-row items-center p-4 bg-green-200 border-b-2 border-green-300 rounded alert top-20">
			<div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-green-100 border-2 border-green-500 rounded-full alert-icon">
				<span class="text-green-500">
					<svg fill="currentColor"
						 viewBox="0 0 20 20"
						 class="w-6 h-6">
						<path fill-rule="evenodd"
							  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
							  clip-rule="evenodd"></path>
					</svg>
				</span>
			</div>
			<div class="ml-4 alert-content">
				<div class="text-lg font-semibold text-green-800 alert-title">
					Success
				</div>
				<div class="text-sm text-green-600 alert-description">
					 {{ $page.props.flash.success }}
				</div>
			</div>
		</div>

        <!-- warning -->
		<div v-if="$page.props.flash.warning && showNotification" class="absolute right-0 z-10 flex flex-row items-center p-4 bg-yellow-200 border-b-2 border-yellow-300 rounded alert top-20">
			<div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-yellow-100 border-2 border-yellow-500 rounded-full alert-icon">
				<span class="text-yellow-500">
					<svg fill="currentColor"
						 viewBox="0 0 20 20"
						 class="w-6 h-6">
						<path fill-rule="evenodd"
							  d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
							  clip-rule="evenodd"></path>
					</svg>
				</span>
			</div>
			<div class="ml-4 alert-content">
				<div class="text-lg font-semibold text-yellow-800 alert-title">
					Warning
				</div>
				<div class="text-sm text-yellow-600 alert-description">
					{{ $page.props.flash.warning }}
				</div>
			</div>
		</div>

        <div v-if="tags != 0">
            <div class="py-6">
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
        </div>

        <div class="text-center" v-else>
            <span class="text-2xl">Aucune catégorie</span>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated'
import { Link, useForm } from '@inertiajs/inertia-vue3'

 import {ref,onMounted} from "vue"

    const showNotification = ref(false);

    onMounted(() => {
        showNotification.value = true;
        setTimeout(() => (showNotification.value = false),2000)
    })


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


