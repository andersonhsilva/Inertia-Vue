<template>
    <AppLayout title="Edit Post">
        <template #header>
            <LayoutNavbar />
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edição de Postagens
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="container mx-auto p-6">
                        <h1>Estou na página de Editar Posts!</h1>

                        <!-- Botão para voltar para a listagem -->
                        <div class="mb-4 flex justify-end">
                            <Link :href="route('dashboard')">
                            <button
                                class="bg-green-700 text-white px-4 py-2 rounded-md hover:bg-black focus:outline-none focus:ring-2 focus:ring-green-300">
                                <i class="fas fa-list"></i> Listagem
                            </button>
                            </Link>
                        </div>

                        <!-- Formulário -->
                        <form @submit.prevent="submitForm">
                            <!-- Campo Title -->
                            <div class="mb-4">
                                <label for="title" class="block text-gray-700 font-bold mb-2">Título</label>
                                <input type="text" id="title" v-model="form.title"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Digite o título do post">
                            </div>

                            <!-- Campo Content -->
                            <div class="mb-4">
                                <label for="content" class="block text-gray-700 font-bold mb-2">Conteúdo</label>
                                <textarea id="content" v-model="form.content"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    rows="5" placeholder="Digite o conteúdo do post"></textarea>
                            </div>

                            <div class="flex justify-end">
                                <!-- Botão Salvar -->
                                <button type="submit" :disabled="form.processing"
                                    class="me-2 bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-300">
                                    <i class="fas fa-save"></i> Salvar
                                </button>

                                <!-- Link Voltar -->
                                <a :href="route('dashboard')" title="Voltar"
                                    class="me-2 bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                    <i class="fas fa-undo-alt"></i> Voltar
                                </a>
                            </div>

                        </form>

                        <div v-if="false" class="mt-5 bg-green-700 text-white p-4 rounded-md">
                            editado com sucesso
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import LayoutNavbar from '@/Layouts/LayoutNavbar.vue';

// Definindo as props para receber o post
const props = defineProps({
    post: {
        type: Object,
        required: true
    },
});

// Inicialize o formulário com os dados recebidos pela prop
const form = useForm({
    id: props.post.id ?? null,
    title: props.post.title ?? '',
    content: props.post.content ?? '',
});

// Método para submeter o formulário
function submitForm() {
    form.put(route('dashboard.update', form.id));
}

</script>