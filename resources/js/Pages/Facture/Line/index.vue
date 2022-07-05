<template>
    <AuthenticatedLayout title="Facture">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Voir tous les champs du fichiers
                </h2>


            </div>

        </template>

        <div v-if="hasErrors">
            <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded"
            v-for="(error, key) in errors" :key="key">
                 {{ error }}
            </div>
        </div>

        <div v-if="$page.props.flash.success"  class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
            <span class="block sm:inline">{{ $page.props.flash.success }}</span>
        </div>

        <!-- <div v-if="$page.props.flash.warning"  class="relative px-4 py-3 text-yellow-700 bg-yellow-100 border border-yellow-400 rounded" role="alert">
            <span class="block sm:inline">{{ $page.props.flash.warning }}</span>
        </div>

        <div v-if="$page.props.flash.danger" class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded">
            {{ $page.props.flash.danger }}
        </div> -->

        <div class="py-4" v-if="lines.length === 0">
                <Link :href="route('facture.index')"
                        class="p-2 px-3 py-2 text-white bg-purple-600 rounded hover:bg-purple-800 dark:bg-purple-700 dark:hover:bg-purple-800">
                       Retour
                </Link>
        </div>



        <form @submit.prevent="submit" class="my-4" enctype="multipart/form-data">
            <input type="file" class="w-58 px-4 mt-2 form-control dark:bg-gray-800
            py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding dark:border-gray-800
            border border-solid border-gray-300 rounded transition ease-in-out dark:text-white
            m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            @input="form.excel_file = $event.target.files[0]" />
            <button type="submit" class="p-1 px-2 my-3 text-white bg-blue-600 rounded hover:bg-blue-700 mx-7">Voir les lignes</button>
        </form>


        <div class="hidden overflow-auto rounded-lg shadow md:block" v-if="lines.length > 0">
            <table class="w-full">
            <thead class="border-b-2 border-gray-200 bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-700">
                <tr>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full">N°Facture

                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full">Fournisseur

                        </span>
                    </th>
                     <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full">Reference

                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full">Date Début

                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full">Date Fin

                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full">Montant HT

                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full">Montant TTC

                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full">Etat de paiement

                        </span>
                    </th>

                </tr>
            </thead>
            <tbody v-for="line in lines" :key="line.id" class="divide-y divide-gray-100">
                <tr class="bg-white dark:bg-gray-800">
                    <td class="p-2 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{line.numero}}</td>
                    <td class="p-3 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{line.nom_affiche_du_partenaire_de_la_facture}}</td>
                    <td class="p-3 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{line.reference}}</td>
                    <td class="p-3 px-6 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{line.date_de_facturation}}</td>
                    <td class="p-3 px-6 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{line.date_decheance}}</td>
                    <td class="p-3 px-6 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{line.montant_ht}} Dhs</td>
                    <td class="p-3 px-6 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{line.total}} Dhs</td>
                    <td class="px-4 text-sm dark:text-white whitespace-nowrap">
                        <span v-if="line.etat_du_paiement === 'Non payées'" class="px-2 py-1 font-semibold leading-tight text-red-400 rounded-sm">{{line.etat_du_paiement}}</span>
                        <span v-else class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">{{line.etat_du_paiement}}</span>

                    </td>

                </tr>
            </tbody>
        </table>
        </div>


        <!-- <pagination class="mt-6" :links="factures.links"/> -->



        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:hidden">
            <div v-for="line in lines" :key="line.id" class="p-4 space-y-3 bg-white rounded-lg shadow dark:bg-gray-800" >
                <div class="flex items-center space-x-2 text-xs">
                    <div class="text-xs">{{line.numero}}</div>
                    <div class="text-xs">{{line.nom_affiche_du_partenaire_de_la_facture}}</div>
                    <div class="text-xs">{{line.date_de_facturation}}</div>
                    <div class="text-xs">{{line.date_decheance}}</div>
                    <div class="text-xs">{{line.montant_ht}}</div>
                    <div class="text-xs">{{line.total}}</div>
                    <div class="text-xs">{{line.etat_du_paiement}}</div>
                </div>
            </div>
        </div>


        <div class="flex items-stretch py-4" v-if="lines.length > 0">
            <div class="block p-1">
                <label for="tags">Sélectionnez une catégorie:</label>
                <select class="p-2 mx-2 border-2 border-gray-300 rounded dark:bg-gray-800 dark:border-gray-800" v-model="form.tag_id">
                    <option v-for="tag in tags" v-bind:key="tag.id" :value="tag.id">{{tag.name}}</option>
                </select>
            </div>
            <div class="flex p-1">
                <Link :href="route('display_lines')" type="submit" class="float-right p-2 px-3 py-2 text-white bg-purple-600 rounded hover:bg-purple-800 dark:bg-purple-700 dark:hover:bg-purple-800">Clear</Link>
            </div>



            <div class="flex p-1">
                <form @submit.prevent="saveFile">
                    <button type="saveFile" class="p-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                            <svg v-show="isLoading" class="absolute w-5 h-5 ml-4 text-white animate-spin" fill="none"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    fill="currentColor">
                                </path>
                            </svg>

                            <span :class="{'invisible': isLoading}">Upload Fichier</span>
                    </button>
                </form>
            </div>

        </div>



    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated'
import { defineComponent } from 'vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

const errors = computed(() => usePage().props.value.errors)

const hasErrors = computed(() => Object.keys(errors.value).length > 0)

</script>

<script>
import {ref} from 'vue';
const isLoading = ref(false);
 import { defineComponent } from 'vue'
 import Pagination from '@/Components/Pagination.vue';
 import { pickBy, throttle } from 'lodash';
 import { Link } from '@inertiajs/inertia-vue3';
 import moment from 'moment';



    export default defineComponent({

        components: {
            Pagination,
            Link
        },

        props:['lines','tags'],

        data() {
            return {
                form: {
                    excel_file:null,
                    tag_id: '',
                },
            };
        },
        methods: {
            submit() {
                this.$inertia.post('/read_lines', this.form)
            },

            saveFile(){
                isLoading.value = true;
                setTimeout(() => isLoading.value = false,2005);
                this.$inertia.post('/save_file',this.form)
            }
        },

    })
</script>
