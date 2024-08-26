<template>

    <div>
        <h1>Estou na Home!</h1>
        <LayoutMenu />
    </div>   

</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import LayoutMenu from '../Layouts/LayoutMenu.vue';

defineOptions({
    name: 'PageHome'
});
// Aqui você pode definir as reativas, props, emit e outras funcionalidades.

</script>

<style lang="scss" scoped></style>
