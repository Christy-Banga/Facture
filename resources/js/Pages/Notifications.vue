<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Notifications
                </h2>
            </div>
        </template>



        <div class="container mx-auto px-6 py-0" v-for="notification in notifications" :key="notification.id">
            <div class="mt-4">
                <div class="flex flex-wrap -mx-6 flex p-4 border-b border-gray-200">

                  <span class="font-bold" >{{ notification.data.info.message }}</span> <span class="ml-1">a ajouté une facture</span> -
                  {{ moment(notification.data.info.sent).fromNow()}}

                    <Link @click="destroy(notification.id)" class="w-5 ml-4 transform hover:text-red-400 hover:scale-110 text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </Link>


                </div>

            </div>




        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated'
</script>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import moment from 'moment';
var locale = moment.locale('fr');
export default {
    props:{
        notifications: Object,
    },

    data() {

        return {
            notifications:this.notifications
        }
    },

    methods:{
        destroy(id){
            this.$inertia.get(route("destroy.notification", id));
        }
    }

}
</script>
