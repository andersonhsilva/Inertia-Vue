<template>
    <div class="container mx-auto p-6">

        <h1>Estou na página de Posts!</h1>

        <!-- Botão para adicionar novo post -->
        <div class="mb-4 flex justify-end">
            <Link :href="route('dashboard.create')">
            <button
                class="bg-green-700 text-white px-4 py-2 rounded-md hover:bg-black focus:outline-none focus:ring-2 focus:ring-green-300">
                <i class="fas fa-plus"></i> Novo
            </button>
            </Link>
        </div>

        <!-- Tabela de posts -->
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Título
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Conteúdo
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="post in posts" :key="post.id" class="hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ post.id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ post.title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> {{ truncate(post.content, 50) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import LayoutMenu from '../Layouts/LayoutMenu.vue';

defineOptions({
    name: 'PagePosts'
});

const props = defineProps(['posts']);

function truncate(text, length) {
    return text.length > length ? text.substring(0, length) + '...' : text;
}

</script>

<style lang="scss" scoped></style>
