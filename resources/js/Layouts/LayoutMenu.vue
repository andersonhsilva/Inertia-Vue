<template>

    <div class="mb-4 text-center">
        <Link :href="route('home')" class="me-4" :class="{ 'font-bold': $page.url === '/home'}">Home</Link>
        <Link :href="route('posts')" class="me-4" :class="{ 'font-bold': $page.url === '/posts'}">Posts</Link>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';

defineOptions({
    name: 'LayoutMenu'
});

</script>

<style></style>