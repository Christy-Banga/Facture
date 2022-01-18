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

        <form @submit.prevent="submit" class="my-4" enctype="multipart/form-data">    
            <input type="file" class="w-58 px-4 py-2 mt-2 border rounded-md focus:outline-none
                focus:ring-1 focus:ring-blue-600" @input="form.excel_file = $event.target.files[0]" />
            <button type="submit" class="bg-blue-500 rounded mx-7 my-3 px-2 p-1 text-white">Upload excel file</button>    
        </form>

        <div class="mb-4 max-w-xs">
            <input type="search" v-model="params.search" aria-label="Search" placeholder="Que recherchez-vous?"
            class="block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div class="overflow-auto rounded-lg shadow hidden md:block">
            <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200">
                <tr>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Numéro de facture</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Nom Fournisseur</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Date Facturation</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Date d'écheance</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Montant HT</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Montant TTC</th>
                </tr>
            </thead>
            <tbody v-for="facture in factures" :key="facture.id" class="divide-y divide-gray-100">
                <tr class="bg-white">
                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{facture.numero_facture}}</td>
                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{facture.nom_fournisseur}}</td>
                    <td class="p-3 px-6 text-sm text-gray-700 whitespace-nowrap">{{facture.date_facturation}}</td>
                    <td class="p-3 px-6 text-sm text-gray-700 whitespace-nowrap">{{facture.date_echeance}}</td>
                    <td class="p-3 px-6 text-sm text-gray-700 whitespace-nowrap">{{facture.montant_HT}} Dhs</td>
                    <td class="p-3 px-6 text-sm text-gray-700 whitespace-nowrap">{{facture.montant_TTC}} Dhs</td>
                </tr>
            </tbody>
        </table>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:hidden">
            <div v-for="facture in factures" :key="facture.id" class="bg-white space-y-3 p-4 rounded-lg shadow" >
                <div class="flex items-center space-x-2 text-xs">
                    <div class="text-xs">{{facture.numero_facture}}</div>
                    <div class="text-xs">{{facture.nom_fournisseur}}</div>
                    <div class="text-xs">{{facture.date_facturation}}</div>
                    <div class="text-xs">{{facture.date_echeance}}</div>
                    <div class="text-xs">{{facture.montant_HT}}</div>
                    <div class="text-xs">{{facture.montant_TTC}}</div>
                </div>
            </div>  
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated'
import Button from '@/Components/Button'
import { GithubIcon } from '@/Components/Icons/brands'
import { defineComponent } from 'vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

const errors = computed(() => usePage().props.value.errors)

const hasErrors = computed(() => Object.keys(errors.value).length > 0)

</script>

<script>
 import { defineComponent } from 'vue'

    export default defineComponent({

        props:['factures'],

        data() {
            return {
                form: {
                    excel_file:null
                },
                params:{
                    search: null,
                },
            };
        },
        watch: {
            params: {
                handler(){
                    this.$inertia.get(this.route('factures.index'), this.params,{replace: true,preserveState:true});
                },
                deep:true,
            }
        },
        methods: {
            submit() {
            this.$inertia.post('/import_facture', this.form)
            },
        },
    })
</script>
