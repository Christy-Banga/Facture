<template>
    <AuthenticatedLayout title="Facture">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Liste des factures
                </h2>

                <div class="">
                    <Link :href="route('display_lines')"
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

             <h1 class="mb-3 text-xl font-bold text-gray-700 dark:text-white">Categories</h1>

             <div class="flex w-32 px-4 py-1 pt-3 mb-7">
                <div v-for="tag in tags" :key="tag.id">
                    <ul>
                        <li>
                            <Link :href="route('facture.index',{'categorie' : tag.name})" class="p-2 mx-1 font-bold text-gray-700 bg-white rounded-lg shadow-md hover:text-gray-600 hover:underline dark:text-white dark:bg-gray-800">
                                {{ tag.name  }}
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>


    <div v-if="factures.length != 0">
        <div class="flex justify-start pt-2">
            <div class="max-w-xs mb-4">
                <input type="search" v-model="params.search" aria-label="Search" placeholder="Que recherchez-vous?"
                    class="block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-800">
            </div>

            <form class="pt-2 mx-3">
                <button type="submit" name="exportPDF">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>

            <form class="pt-3">
                <button type="submit" name="print" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                    </svg>
                </button>
            </form>
            <div class="absolute p-3 right-6 top-60 ">
            <select v-model="perPage" @change="getFact" class="w-32 px-4 py-3 text-sm border-transparent rounded-md dark:bg-gray-800 focus:border-gray-500 focus:bg-white focus:ring-0" name="" id="">
                <option value="5">5 par page</option>
                <option value="10">10 par page</option>
                <option value="15">15 par page</option>
            </select>
        </div>
        </div>



        <div class="overflow-auto rounded-lg shadow">
            <table class="w-full">
            <thead class="border-b-2 border-gray-200 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-700">
                <tr>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full" @click="sort('numero_facture')">N°Facture
                            <svg v-if="params.field === 'numero_facture' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                             <svg v-if="params.field === 'numero_facture' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full" @click="sort('nom_fournisseur')">Fournisseur
                            <svg v-if="params.field === 'nom_fournisseur' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'nom_fournisseur' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                     <th class="p-2 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full" @click="sort('reference')">Reference
                            <svg v-if="params.field === 'reference' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'reference' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full" @click="sort('date_facturation')">Date Début
                            <svg v-if="params.field === 'date_facturation' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'date_facturation' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full" @click="sort('date_echeance')">Date Fin
                            <svg v-if="params.field === 'date_echeance' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'date_echeance' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full" @click="sort('montant_HT')">Montant HT
                            <svg v-if="params.field === 'montant_HT' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'montant_HT' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full" @click="sort('montant_TTC')">Montant TTC
                            <svg v-if="params.field === 'montant_TTC' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'montant_TTC' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th class="p-2 text-sm font-semibold tracking-wide text-left">
                        <span class="inline-flex justify-between w-full" @click="sort('etat_paiement')">Etat de paiement
                            <svg v-if="params.field === 'etat_paiement' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                            </svg>
                            <svg v-if="params.field === 'etat_paiement' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                            </svg>
                        </span>
                    </th>
                    <th v-if="$page.props.permission.users.create">Actions</th>
                </tr>
            </thead>
            <tbody v-for="facture in factures.data" :key="facture.id" class="divide-y divide-gray-100">
                <tr class="bg-white dark:bg-gray-800">
                    <td class="p-2 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{facture.numero_facture}}</td>
                    <td class="p-2 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{facture.nom_fournisseur}}</td>
<!--                     <td class="p-2 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{moment(facture.date_facturation).format('MMMM YYYY')}}</td> -->
                    <td class="p-2 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{facture.reference}}</td>
                    <td class="p-2 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{facture.date_facturation}}</td>
                  <td class="p-2 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{facture.date_echeance}}</td>
                    <td class="p-2 px-4 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{facture.montant_HT}} Dhs</td>
                    <td class="p-2 px-6 text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap">{{facture.montant_TTC}} Dhs</td>
                    <td class="px-6 text-sm text-gray-700 dark:text-white whitespace-nowrap">
                        <span v-if="facture.etat_paiement === 'Non payées'" class="px-2 py-1 font-semibold leading-tight text-red-400 rounded-sm">{{facture.etat_paiement}}</span>
                        <span v-else class="px-2 py-1 font-semibold leading-tight text-green-700 rounded-sm">{{facture.etat_paiement}}</span>
                    </td>
                    <td v-if="$page.props.permission.users.create" class="px-6 py-3 text-center">
                        <div class="flex justify-center item-center" >
                            <Link :href="route('facture.edit', facture.id)" class="w-4 mr-2 text-purple-900 transform hover:text-purple-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="dark:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </Link>
                            <Link  @click="destroy(facture.id)" class="w-4 mr-2 text-red-600 transform hover:text-red-400 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </Link>
                        </div>
                    </td>
                </tr>
            </tbody>
                <tr class="w-full">
                    <td></td>
                    <td class="pl-5 text-2xl">Total</td>
                    <td></td>
                    <td></td>

                    <td class="pl-3 text-lg">{{prixTotalFactureHT}} Dhs</td>

                    <td class="pl-5 text-lg">{{ prixTotalFactureTTC }} Dhs</td>
                </tr>
            </table>
        </div>





     <!--    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:hidden">
            <div v-for="facture in factures.data" :key="facture.id" class="p-4 space-y-3 bg-white rounded-lg shadow dark:bg-gray-800" >
                <div class="flex items-center space-x-2 text-xs">
                    <div class="text-xs">{{facture.numero_facture}}</div>
                    <div class="text-xs">{{facture.nom_fournisseur}}</div>
                    <div class="text-xs">{{facture.date_facturation}}</div>
                    <div class="text-xs">{{facture.date_echeance}}</div>
                    <div class="text-xs">{{facture.montant_HT}}</div>
                    <div class="text-xs">{{facture.montant_TTC}}</div>
                    <div class="text-xs">{{facture.etat_paiement}}</div>
                </div>
            </div>
        </div> -->
</div>

<div v-else>
    PAsde facture
</div>

        <pagination class="mt-6" :links="factures.links"/>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated'
import { defineComponent } from 'vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
 import {ref,onMounted} from "vue"

const errors = computed(() => usePage().props.value.errors)

const hasErrors = computed(() => Object.keys(errors.value).length > 0)


    const showNotification = ref(false);

    onMounted(() => {
        showNotification.value = true;
        setTimeout(() => (showNotification.value = false),2000)
    })



</script>

<script>
 import { defineComponent } from 'vue'
 import Pagination from '@/Components/Pagination.vue';
 import { pickBy, throttle,debounce } from 'lodash';
 import { Link } from '@inertiajs/inertia-vue3';
 import moment from 'moment';
 var locale = moment.locale('fr');
const perPage = ref(5);


    export default defineComponent({

        components: {
            Pagination,
            Link
        },

        props:['factures','filters','prixTotalFactureTTC','prixTotalFactureHT','tags'],

        data() {
            return {
                perPage : 5,

                form: {
                    excel_file:null,
                },
                params:{
                    search: this.filters.search,
                    field: this.filters.field,
                    direction: this.filters.direction,
                    perPage: this.filters.perPage
                },
            };
        },
        methods: {
            sort(field){
                this.params.field = field;
                this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
            },

             destroy(id) {
                 if(confirm('Voulez-vous vraiment supprimé cette facture?'))
                this.$inertia.delete(route("facture.destroy", id));
            },

          submit: function(){
            this.$refs.form.submit()
            },

            getFact(){

            this.$inertia.get(
                "/facture",
                {perPage: perPage.value},
                {
                    preserveState: true,
                    replace : true
                }
                )
            }

        },
        watch: {
            params: {
                handler: debounce(function(){
                    console.log('aa');
                    let params = pickBy(this.params);

                    this.$inertia.get(this.route('facture.index'), params,{replace: true,preserveState:true});
                },350),
                deep:true,
            },
        },
    })
</script>
