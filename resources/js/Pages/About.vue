<template>
    
    <Head>
        <title>About</title>
    </Head>

    <div>
        <h1>Estou na About!</h1>
        <h2>Olá {{ name }}, você está estudando o curso de: {{ course }}</h2>

        <LayoutMenu />
    </div>
</template>

<script setup>
import { Link, Head } from '@inertiajs/inertia-vue3';
import LayoutMenu from '../Layouts/LayoutMenu.vue';

defineOptions({
    name: 'PageAbout'
});

// Aqui você pode definir as reativas, props, emit e outras funcionalidades.
const props = defineProps(['name', 'course']);

</script>

<style lang="scss" scoped></style>
