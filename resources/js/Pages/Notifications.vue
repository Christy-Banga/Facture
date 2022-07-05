<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Notifications
                </h2>
            </div>
        </template>

        <div class="py-3">
            <div v-if="$page.props.flash.danger" class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded">
                {{ $page.props.flash.danger }}
            </div>
        </div>


        <div class="container px-6 py-0 mx-auto" v-for="notification in notifications" :key="notification.id">
            <div class="mt-4">
                <div class="flex flex-wrap p-4 -mx-6 border-b border-gray-200">

                  <span class="font-bold" >{{ notification.data.info.name }}</span> <span class="ml-1">a ajouté une facture</span> -
                  <i>{{ moment(notification.data.info.sent).fromNow()}}</i>

                    <Link @click="destroy(notification.id)" class="w-5 ml-4 text-red-600 transform hover:text-red-400 hover:scale-110">
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

   /*  data() {

        return {
            notifications:this.notifications
        }
    }, */

    methods:{
        destroy(id){
            this.$inertia.delete(route("destroy.notification", id));
        }
    }

}
</script>
