<template>
    <AuthenticatedLayout title="Facture">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                   Facture > Modifier
                </h2>
            </div>
        </template>

        <!-- component -->
       
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-800">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label for="numero_facture" class="text-xl text-gray-600 dark:text-white">Numéro de facture <span class="text-red-500">*</span></label>
                            <input type="text" v-model="form.numero_facture" disabled class="border-2 border-gray-300 p-2 w-full dark:border-gray-700 dark:bg-gray-900" id="numero_facture">
                            <div class="bg-red-200 py-2 my-1 text-red-500" v-if="form.errors.numero_facture">{{ form.errors.numero_facture }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="numero_facture" class="text-xl text-gray-600 dark:text-white">Nom Fournisseur <span class="text-red-500">*</span></label>
                            <input type="text" v-model="form.nom_fournisseur" disabled class="border-2 border-gray-300 p-2 w-full dark:border-gray-700 dark:bg-gray-900" id="nom_fournisseur">
                            <div class="bg-red-200 py-2 my-1 text-red-500" v-if="form.errors.nom_fournisseur">{{ form.errors.nom_fournisseur }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="date_facturation" class="text-xl text-gray-600 dark:text-white">Date Facturation <span class="text-red-500">*</span></label>
                            <input type="date" v-model="form.date_facturation" class="border-2 border-gray-300 p-2 w-full dark:border-gray-700 dark:bg-gray-900" id="date_facturation">
                            <div class="bg-red-200 py-2 my-1 text-red-500" v-if="form.errors.date_facturation">{{ form.errors.date_facturation }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="date_echeance" class="text-xl text-gray-600 dark:text-white">Date Facturation <span class="text-red-500">*</span></label>
                            <input type="date" v-model="form.date_echeance" class="border-2 border-gray-300 p-2 w-full dark:border-gray-700 dark:bg-gray-900" id="date_echeance">
                            <div class="bg-red-200 py-2 my-1 text-red-500" v-if="form.errors.date_echeance">{{ form.errors.date_echeance }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="montant_HT" class="text-xl text-gray-600 dark:text-white">Montant HT <span class="text-red-500">*</span></label>
                            <input type="numeric" v-model="form.montant_HT" class="border-2 border-gray-300 p-2 w-full dark:border-gray-700 dark:bg-gray-900" id="montant_HT">
                            <div class="bg-red-200 py-2 my-1 text-red-500" v-if="form.errors.montant_HT">{{ form.errors.montant_HT }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="montant_TTC" class="text-xl text-gray-600 dark:text-white">Montant TTC <span class="text-red-500">*</span></label>
                            <input type="numeric" v-model="form.montant_TTC" class="border-2 border-gray-300 p-2 w-full dark:border-gray-700 dark:bg-gray-900" id="montant_TTC">
                            <div class="bg-red-200 py-2 my-1 text-red-500" v-if="form.errors.montant_TTC">{{ form.errors.montant_TTC }}</div>
                        </div>

                        <div class="flex items-stretch">
                            <div class="flex p-1">
                                <Link :href="route('facture.index')" type="submit" class="text-white p-2 bg-purple-600 hover:bg-purple-800 dark:bg-purple-700 dark:hover:bg-purple-800 px-3 py-2 float-right rounded">Retour</Link>
                            </div>
                            <div class="flex p-1">
                                <button type="submit" class="text-white p-2 bg-blue-600 hover:bg-blue-800 dark:bg-gray-700 dark:hover:bg-gray-800 px-3 py-2 float-right rounded">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated'
import { Link, useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
    numero_facture: String,
    nom_fournisseur: String,
    date_facturation: Date,
    date_echeance: Date,
    montant_HT: Number,
    montant_TTC: Number,
    facture: Object,
})

    const form = useForm({
        _method: 'PUT',
        numero_facture: props.facture.numero_facture,
        nom_fournisseur: props.facture.nom_fournisseur,
        date_facturation: props.facture.date_facturation,
        date_echeance: props.facture.date_echeance,
        montant_HT: props.facture.montant_HT,
        montant_TTC: props.facture.montant_TTC,

    })

    const submit = () => {

        form.post(route('facture.update',props.facture.id), {
                preserveScroll: true,
            });
    };





</script>

