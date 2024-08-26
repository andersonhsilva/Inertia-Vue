<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import Posts from '@/Pages/Posts.vue';
import LayoutNavbar from '@/Layouts/LayoutNavbar.vue';

const props = defineProps(['posts']);

defineOptions({
    name: 'Dashboard'
});

</script>

<template>
    <AppLayout title="Dashboard">

        <template #header>

            <LayoutNavbar/>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Listagem de Postagens
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- <Welcome /> -->
                    <Posts :posts="posts" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
