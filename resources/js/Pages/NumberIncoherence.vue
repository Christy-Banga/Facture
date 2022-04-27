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
                <div class="container mx-auto px-6 py-0">
                                <!-- component -->
                    <div class="relative py-3 w-11/12 max-w-xl sm:mx-auto">
                    <div>La facture <span class="font-bold text-sm">{{ monttMaxFac.numero_facture }}</span> à le plus grand montant qui est de <span class="font-bold text-sm">{{ monttMaxFac.montant_TTC }}</span> dhs</div>
                    <div>La facture <span class="font-bold text-sm">{{ monttMinFac.numero_facture }}</span> à le plus petit montant qui est de <span class="font-bold text-sm">{{ monttMinFac.montant_TTC }}</span> dhs</div>
                    <div>La somme de toutes les factures est de <span class="font-bold text-sm">{{ prixTotalFacture }}</span> dhs</div>

                <div class="py-3">
                    <Link href="#" class="bg-blue-500 px-2 p-1 text-white rounded">Generer un report</Link>
                </div>
    <!--
                        <div class="relative p-8 bg-white shadow-sm sm:rounded-xl">
                        <form class="w-full" @submit.prevent="submit">
                            <div class="mb-5 relative">
                            <input type="number" v-model="form.valeur_global" class="peer pt-8 border border-gray-200 focus:outline-none rounded-md focus:border-gray-500 focus:shadow-sm w-full p-3 h-16 placeholder-transparent" placeholder="name@example.com" autocomplete="off" />
                            <label for="valeur_global" class="peer-placeholder-shown:opacity-100   opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">Valeur globale</label>
                            </div>
                            <div class="mb-5 relative">
                            <input type="password" id="password" class="peer pt-8 border border-gray-200 focus:outline-none rounded-md focus:border-gray-500 focus:shadow-sm w-full p-3 h-16 placeholder-transparent" placeholder="password" autocomplete="off" />
                            <label for="password" class="peer-placeholder-shown:opacity-100   opacity-75 peer-focus:opacity-75 peer-placeholder-shown:scale-100 scale-75 peer-focus:scale-75 peer-placeholder-shown:translate-y-0 -translate-y-3 peer-focus:-translate-y-3 peer-placeholder-shown:translate-x-0 translate-x-1 peer-focus:translate-x-1 absolute top-0 left-0 px-3 py-5 h-full pointer-events-none transform origin-left transition-all duration-100 ease-in-out">Password</label>
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 text-white p-3 rounded-md">
                                <svg v-show="isLoading" class="w-5 h-5 text-white animate-spin absolute ml-4" fill="none"
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
                            <div v-if="$page.props.flash.success"  class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
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
