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
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
            v-for="(error, key) in errors" :key="key">
                 {{ error }}
            </div>
        </div>

        <div v-if="$page.props.flash.success"  class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ $page.props.flash.success }}</span>
        </div>

        <!-- <div v-if="$page.props.flash.warning"  class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ $page.props.flash.warning }}</span>
        </div>

        <div v-if="$page.props.flash.danger" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            {{ $page.props.flash.danger }}
        </div> -->

        <div class="py-4" v-if="lines.length === 0">
                <Link :href="route('facture.index')"
                        class="text-white p-2 bg-purple-600 hover:bg-purple-800 dark:bg-purple-700 dark:hover:bg-purple-800 px-3 py-2 rounded">
                       Retour
                </Link>
            </div>

        <form @submit.prevent="submit" class="my-4" enctype="multipart/form-data">
            <input type="file" class="w-58 px-4 py-2 mt-2 form-control dark:bg-gray-800 px-3
            py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding dark:border-gray-800
            border border-solid border-gray-300 rounded transition ease-in-out dark:text-white
            m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            @input="form.excel_file = $event.target.files[0]" />
            <button type="submit" class="bg-blue-600 rounded mx-14 hover:bg-blue-700 rounded mx-7 my-3 px-2 p-1 text-white">Voir les lignes</button>
        </form>


        <div class="overflow-auto rounded-lg shadow hidden md:block" v-if="lines.length > 0">
            <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200 dark:bg-gray-700 dark:border-gray-700">
                <tr>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between">Numéro de facture

                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between">Nom Fournisseur

                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between">Date Facturation

                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between">Date d'écheance

                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between">Montant HT

                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between">Montant TTC

                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between">Etat de paiement

                        </span>
                    </th>

                </tr>
            </thead>
            <tbody v-for="line in lines" :key="line.id" class="divide-y divide-gray-100">
                <tr class="bg-white dark:bg-gray-800">
                    <td class="p-3 text-sm dark:text-white text-gray-700 whitespace-nowrap">{{line.numero}}</td>
                    <td class="p-3 text-sm dark:text-white text-gray-700 whitespace-nowrap">{{line.nom_affiche_du_partenaire_de_la_facture}}</td>
                    <td class="p-3 px-6 text-sm dark:text-white text-gray-700 whitespace-nowrap">{{line.date_de_facturation}}</td>
                    <td class="p-3 px-6 text-sm dark:text-white text-gray-700 whitespace-nowrap">{{line.date_decheance}}</td>
                    <td class="p-3 px-6 text-sm dark:text-white text-gray-700 whitespace-nowrap">{{line.montant_ht}} Dhs</td>
                    <td class="p-3 px-6 text-sm dark:text-white text-gray-700 whitespace-nowrap">{{line.total}} Dhs</td>
                    <td class="p-3 px-6 text-sm dark:text-white text-gray-700 whitespace-nowrap">
                        <span v-if="line.etat_du_paiement=== 'Non payées'" class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm">{{line.etat_du_paiement}}</span>
                        <span v-else class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">{{line.etat_du_paiement}}</span>

                    </td>

                </tr>
            </tbody>
        </table>
        </div>


        <!-- <pagination class="mt-6" :links="factures.links"/> -->



        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
            <div v-for="line in lines" :key="line.id" class="bg-white space-y-3 p-4 rounded-lg shadow dark:bg-gray-800" >
                <div class="flex items-center space-x-2 text-xs">
                    <div class="text-xs">{{line.numero}}</div>
                    <div class="text-xs">{{line.nom_affiche_du_partenaire_de_la_facture}}</div>
                    <div class="text-xs">{{line.date_de_facturation}}</div>
                    <div class="text-xs">{{moment(line.date_decheance).format('Y-m-d')}}</div>
                    <div class="text-xs">{{line.montant_ht}}</div>
                    <div class="text-xs">{{line.total}}</div>
                    <div class="text-xs">{{line.etat_du_paiement}}</div>
                </div>
            </div>
        </div>

        <div class="flex items-stretch py-4" v-if="lines.length > 0">
            <div class="flex p-1">
                <Link :href="route('display_lines')" type="submit" class="text-white p-2 bg-purple-600 hover:bg-purple-800 dark:bg-purple-700 dark:hover:bg-purple-800 px-3 py-2 float-right rounded">Clear</Link>
            </div>

            <div class="flex p-1">
                <form @submit.prevent="saveFile">
                    <button type="saveFile" class="bg-blue-600 rounded hover:bg-blue-700 p-2 rounded text-white">
                        Upload fichier
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

        props:['lines'],

        data() {
            return {
                form: {
                    excel_file:null
                },
            };
        },
        methods: {
            submit() {
                this.$inertia.post('/read_lines', this.form)
            },

            saveFile(){
                this.$inertia.post('/save_file')
            }
        },

    })
</script>
