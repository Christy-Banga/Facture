<template>
    <AuthenticatedLayout title="Facture">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Liste des factures
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

        <div v-if="$page.props.flash.warning"  class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ $page.props.flash.warning }}</span>
        </div>

        <div v-if="$page.props.flash.danger" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            {{ $page.props.flash.danger }}
        </div>

        <form @submit.prevent="submit" class="my-4" enctype="multipart/form-data">
            <input type="file" class="w-58 px-4 py-2 mt-2 form-control dark:bg-gray-800 px-3
            py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding dark:border-gray-800
            border border-solid border-gray-300 rounded transition ease-in-out dark:text-white
            m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            @input="form.excel_file = $event.target.files[0]" />
            <button type="submit" class="bg-blue-500 rounded mx-7 my-3 px-2 p-1 text-white">Upload excel file</button>
        </form>

       <!--  <div class="mb-4 max-w-xs">
            <input type="search" v-model="params.search" aria-label="Search" placeholder="Que recherchez-vous?"
            class="block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-800 dark:border-gray-800">
        </div> -->

        <div class="overflow-auto rounded-lg shadow hidden md:block">
            <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200 dark:bg-gray-700 dark:border-gray-700">
              <!--   <tr>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between" @click="sort('numero_facture')">Numéro de facture
                            <svg v-if="params.field === 'numero_facture' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                             <svg v-if="params.field === 'numero_facture' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between" @click="sort('nom_fournisseur')">Nom Fournisseur
                            <svg v-if="params.field === 'nom_fournisseur' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'nom_fournisseur' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between" @click="sort('date_facturation')">Date Facturation
                            <svg v-if="params.field === 'date_facturation' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'date_facturation' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between" @click="sort('date_echeance')">Date d'écheance
                            <svg v-if="params.field === 'date_echeance' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'date_echeance' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between" @click="sort('montant_HT')">Montant HT
                            <svg v-if="params.field === 'montant_HT' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'montant_HT' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between" @click="sort('montant_TTC')">Montant TTC
                            <svg v-if="params.field === 'montant_TTC' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'montant_TTC' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex w-full justify-between" @click="sort('etat_paiement')">Etat de paiement
                            <svg v-if="params.field === 'etat_paiement' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'etat_paiement' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th v-if="$page.props.permission.users.create">Actions</th>
                </tr> -->
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
                        {{line.etat_du_paiement}} Dhs
                    </td>
                    <td>
                        <button @click="saveFile()">Sauvegarder le fichier</button>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>

        <!-- <pagination class="mt-6" :links="factures.links"/> -->

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
            <!-- <div v-for="facture in factures.data" :key="facture.id" class="bg-white space-y-3 p-4 rounded-lg shadow dark:bg-gray-800" >
                <div class="flex items-center space-x-2 text-xs">
                    <div class="text-xs">{{facture.numero_facture}}</div>
                    <div class="text-xs">{{facture.nom_fournisseur}}</div>
                    <div class="text-xs">{{facture.date_facturation}}</div>
                    <div class="text-xs">{{facture.date_echeance}}</div>
                    <div class="text-xs">{{facture.montant_HT}}</div>
                    <div class="text-xs">{{facture.montant_TTC}}</div>
                    <div class="text-xs">{{facture.etat_paiement}}</div>
                </div>
            </div> -->
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
                /* params:{
                    search: this.filters.search,
                    field: this.filters.field,
                    direction: this.filters.direction
                }, */
            };
        },
        methods: {
           /*  sort(field){
                this.params.field = field;
                this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
            }, */
            submit() {
                this.$inertia.post('/read_lines', this.form)
            },

            saveFile(){
                this.$inertia.post('/save_file')
            }

           /*   destroy(id) {
                 if(confirm('Voulez-vous vraiment supprimé cette facture?'))
                this.$inertia.delete(route("facture.destroy", id));
            }, */
        },
     /*    watch: {
            params: {
                handler: throttle(function(){
                    let params = pickBy(this.params);

                    this.$inertia.get(this.route('facture.index'), params,{replace: true,preserveState:true});
                },150),
                deep:true,
            },
        }, */
    })
</script>
