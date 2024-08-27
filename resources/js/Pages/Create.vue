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

                        <form @submit.prevent="submitForm">

                            <!-- Campo Title -->
                            <div class="mb-4">
                                <label for="title" class="block text-gray-700 font-bold mb-2">Título</label>
                                <input type="text" id="title" v-model="form.title"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Digite o título do post">
                                <div v-if="form.errors.email">{{ form.errors.title }}</div>
                            </div>

                            <!-- Campo Content -->
                            <div class="mb-4">
                                <label for="content" class="block text-gray-700 font-bold mb-2">Conteúdo</label>
                                <textarea id="content" v-model="form.content"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    rows="5" placeholder="Digite o conteúdo do post"></textarea>
                                <div v-if="form.errors.email">{{ form.errors.content }}</div>
                            </div>

                            <div class="flex justify-end">
                                <!-- Botão Salvar -->
                                <button type="submit" :disabled="form.processing"
                                    class="me-2 bg-green-700 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                    <i class="fas fa-save"></i> Salvar
                                </button>

                                <!-- Link Voltar -->
                                <a :href="route('dashboard')" title="Voltar"
                                    class="me-2 bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                    <i class="fas fa-undo-alt"></i> Voltar
                                </a>
                            </div>
                        </form>

                        <!-- exibe a mensagem do backend vinda do envio do formulario -->
                        <div v-if="messageForm.show" class="mt-5 text-white p-4 rounded-md"
                            :class="messageForm.type === 'success' ? 'bg-green-700' : 'bg-red-700'">
                            {{ messageForm.message }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
// importacoes des dependencias utilizadas no codigo
import { ref, reactive } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import LayoutNavbar from '@/Layouts/LayoutNavbar.vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';

// define o setup do componente
defineOptions({
    name: 'Create'
});

// propriedades de objetos
const props = defineProps(['objResult']);

// diretivas de feedback do formulario ao usuario
const messageForm = reactive({
    show: false,
    object: null,
    type: undefined,
    message: undefined,
});

// campos do formulario para o model
const form = useForm({
    title: '',
    content: ''
});

// envia o formulario pelo inertia
const submitForm = () => {
    form.transform((data) => ({
        ...data,
        /* manipula os dados antes do envio do formulario */
    })).post(route('dashboard.store'), {
        preserveScroll: true,
        onProgress: (progress) => {
            console.log(`Progresso: ${progress.percentage}%`);
        },
        onSuccess: (response) => {
            console.log(response);
            handleResponse();
            form.reset();
        },
        onError: (errors) => {
            console.log(errors);
            handleResponse();
        }
    });
}

// atualiza as diretivas de variaveis conforme dados do backend
const handleResponse = () => {
    const { object, type, message } = props.objResult;
    messageForm.object = object;
    messageForm.type = type;
    messageForm.message = message;
    messageForm.show = true;
    setTimeout(() => {
        messageForm.show = false;
    }, 10000);
}
</script>