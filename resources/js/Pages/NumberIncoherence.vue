<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Incoherence
                </h2>
            </div>
        </template>

            <div class="py-4">
                <div class="container px-6 py-0 mx-auto">
                                <!-- component -->
                    <div class="relative w-11/12 max-w-xl py-3 sm:mx-auto">
                    <div>La facture <span class="text-sm font-bold">{{ monttMaxFac.numero_facture }}</span> a le plus grand montant qui est de <span class="text-sm font-bold">{{ monttMaxFac.montant_TTC }}</span> dhs</div>
                    <div>La facture <span class="text-sm font-bold">{{ monttMinFac.numero_facture }}</span> a le plus petit montant qui est de <span class="text-sm font-bold">{{ monttMinFac.montant_TTC }}</span> dhs</div>
                    <div>La somme de toutes les factures est de <span class="text-sm font-bold">{{ prixTotalFacture }}</span> dhs</div>

               <!--  <div class="py-3">
                    <Link href="#" class="p-1 px-2 text-white bg-blue-500 rounded">Generer un report</Link>
                </div> -->
    <!--
                        <div class="relative p-8 bg-white shadow-sm sm:rounded-xl">
                        <form class="w-full" @submit.prevent="submit">
                            <div class="relative mb-5">
                            <input type="number" v-model="form.valeur_global" class="w-full h-16 p-3 pt-8 placeholder-transparent border border-gray-200 rounded-md peer focus:outline-none focus:border-gray-500 focus:shadow-sm" placeholder="name@example.com" autocomplete="off" />
                            <label for="valeur_global" class="absolute top-0 left-0 h-full px-3 py-5 transition-all duration-100 ease-in-out origin-left transform scale-75 translate-x-1 -translate-y-3 opacity-75 pointer-events-none peer-placeholder-shown:opacity-100 peer-focus:opacity-75 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 peer-focus:translate-x-1">Valeur globale</label>
                            </div>
                            <div class="relative mb-5">
                            <input type="password" id="password" class="w-full h-16 p-3 pt-8 placeholder-transparent border border-gray-200 rounded-md peer focus:outline-none focus:border-gray-500 focus:shadow-sm" placeholder="password" autocomplete="off" />
                            <label for="password" class="absolute top-0 left-0 h-full px-3 py-5 transition-all duration-100 ease-in-out origin-left transform scale-75 translate-x-1 -translate-y-3 opacity-75 pointer-events-none peer-placeholder-shown:opacity-100 peer-focus:opacity-75 peer-placeholder-shown:scale-100 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 peer-focus:translate-x-1">Password</label>
                            </div>
                            <button type="submit" class="w-full p-3 text-white bg-indigo-600 rounded-md">
                                <svg v-show="isLoading" class="absolute w-5 h-5 ml-4 text-white animate-spin" fill="none"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                        fill="currentColor">
                                    </path>
                                </svg>

                                <span :class="{'invisible': isLoading}">Submit</span>
                            </button>
                        </form>
                        </div>
                        <div class="py-3">
                            <div v-if="$page.props.flash.success"  class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                                <span class="block sm:inline">{{ $page.props.flash.success }}</span>
                            </div>
                        </div> -->
                </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated'
import { Link } from '@inertiajs/inertia-vue3';
</script>

<script>
import {ref} from 'vue';
const isLoading = ref(false);
export default {

    components:{
        Link
    },

    props:{
        monttMaxFac: Number,
        monttMinFac: Number,
        prixTotalFacture: Number,
        /* monttMoyFac:Object */

    },

    data()
    {
        return {
            form:{
                valeur_global: null,
            }
        }
    },

    methods:{
        submit(){
            isLoading.value = true;
            setTimeout(() => isLoading.value = false,400);
            this.$inertia.post(route('incoherence.store'),this.form);
        }
    }

}
</script>
