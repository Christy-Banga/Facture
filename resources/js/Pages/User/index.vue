<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Liste des gestionnaires
                </h2>

                <div>
                    <Link v-if="$page.props.permission.users.create" :href="route('gestionnaire.create')"
                        class="p-3 w-16 h-16 bg-blue-600 rounded mx-14 hover:bg-blue-700 active:shadow-lg mouse shadow transition ease-in duration-200 focus:outline-none">
                            <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-6 h-6 inline-block">
                                <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z" />
                            </svg>
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div>
                    <div v-if="$page.props.flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ $page.props.flash.success }}
                    </div>
                </div>

                <div>
                    <div v-if="$page.props.flash.warning" class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative">
                    {{ $page.props.flash.warning }}
                    </div>
                </div>

                <div class="py-3">
                    <div v-if="$page.props.flash.danger" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ $page.props.flash.danger }}
                    </div>
                </div>

                <div class="mb-4 max-w-xs">
                    <input type="search" v-model="params.search" aria-label="Search" placeholder="Que recherchez-vous?" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-800"/>
                </div>

                <!-- component -->

                <div class="overflow-auto rounded-lg shadow  md:block">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-700">
                            <tr>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left">
                                    <span class="inline-flex w-full justify-between" @click="sort('name')">Name
                                        <svg v-if="params.field === 'name' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                        </svg>
                                        <svg v-if="params.field === 'name' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                        </svg>
                                    </span>
                                </th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left">
                                    <span class="inline-flex w-full justify-between" @click="sort('email')">Email
                                        <svg v-if="params.field === 'email' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                        </svg>
                                        <svg v-if="params.field === 'email' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                        </svg>
                                    </span>
                                </th>
                                <th class="p-3 text-sm font-semibold tracking-wide text-left">
                                    <span class="inline-flex w-full justify-between" @click="sort('role')">Role
                                        <svg v-if="params.field === 'role' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                        </svg>
                                        <svg v-if="params.field === 'role' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                        </svg>
                                    </span>
                                </th>
                                <th v-if="$page.props.permission.users.create">Actions</th>
                            </tr>
                        </thead>
                        <tbody v-for="user in users.data" :key="user.id" class="divide-y divide-gray-100">
                            <tr class="bg-white dark:bg-gray-800">
                                <td class="p-3 text-sm dark:text-gray-300 text-gray-700 whitespace-nowrap">{{user.name}}</td>
                                <td class="p-3 text-sm dark:text-gray-300 text-gray-700 whitespace-nowrap">{{user.email}}</td>
                                <td class="p-3 px-6 text-sm dark:text-gray-300 text-gray-700 whitespace-nowrap">{{user.role}}</td>
                                <td v-if="$page.props.permission.users.create" class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center" v-show="user.role != 'admin'">
                                        <Link v-if="user.can.update" :href="route('gestionnaire.edit', user.id)" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 text-purple-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </Link>
                                        <Link v-if="user.can.update" @click="destroy(user.id)" class="w-4 mr-2 transform hover:text-red-400 hover:scale-110 text-red-600">
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
                <pagination class="mt-6" :links="users.links"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/Authenticated'
</script>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import { pickBy, throttle } from 'lodash';

    export default defineComponent({
        components: {
            Link
        },

         props : ['users','filters'],

        data() {
            return {
                params: {
                    search: this.filters.search,
                    field: this.filters.field,
                    direction: this.filters.direction,
                },
            };
        },

        methods: {
            destroy(id) {
                if(confirm('Voulez-vous vraiment supprimé cet utilisateur?'))
                this.$inertia.delete(route("gestionnaire.destroy", id));
            },

            sort(field) {
                this.params.field = field;
                this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
            }
        },

        watch: {
            params: {
                handler: throttle(function () {
                    let params = pickBy(this.params);

                    this.$inertia.get(this.route('gestionnaire.index'), params, { replace: true, preserveState: true });
                }, 150),
                deep: true,
            }
        },


    })
</script>
