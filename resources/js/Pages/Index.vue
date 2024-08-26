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
                    <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase">Título</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase">Conteúdo
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase">Ação</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="post in posts" :key="post.id" class="hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ post.id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ post.title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> {{ truncate(post.content, 50) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <a :href="route('dashboard.edit', { id: post.id })" title="Editar"
                            class="me-2 px-2 py-2 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a :href="route('dashboard.destroy', { id: post.id })" title="Excluir"
                            class="me-2 px-2 py-2 bg-red-600 text-white text-xs rounded hover:bg-red-700 focus:bg-red-700 active:bg-red-800"
                            @click.prevent="deletePost(post.id)">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

defineOptions({
    name: 'Inddex'
});

const props = defineProps(['posts']);

function deletePost(id) {
    if (confirm('Tem certeza que deseja excluir esta postagem?')) {
        Inertia.delete(route('dashboard.destroy', { id }));
    }
};

function truncate(text, length) {
    return text.length > length ? text.substring(0, length) + '...' : text;
}

</script>

<style lang="scss" scoped></style>
