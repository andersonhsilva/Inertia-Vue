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
                                <input v-model="form.title" type="text" id="title" name="title"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Digite o título do post">
                            </div>

                            <!-- Campo Content -->
                            <div class="mb-4">
                                <label for="content" class="block text-gray-700 font-bold mb-2">Conteúdo</label>
                                <textarea v-model="form.content" id="content" name="content"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    rows="5" placeholder="Digite o conteúdo do post"></textarea>
                            </div>

                            <div class="flex justify-end">
                                <!-- Botão Salvar -->
                                <button :disabled="form.processing" type="submit"
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
import { ref, reactive } from 'vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import LayoutNavbar from '@/Layouts/LayoutNavbar.vue';

// define o nome do setup do componente para debug
defineOptions({
    name: 'Edit',
});

// Definindo as props para receber o post
const props = defineProps(['eObject']);

// Inicialize o formulário com os dados recebidos pela prop
const form = useForm({
    id: props.eObject.id ?? null,
    title: props.eObject.title ?? '',
    content: props.eObject.content ?? '',
});

// diretivas de feedback do formulario ao usuario
const messageForm = reactive({
    show: false,
    object: null,
    type: undefined,
    message: undefined,
    timeOutMessage: null,
});

// envia o formulario pelo inertia
const submitForm = () => {
    form.put(route('dashboard.update', form.id), {
        preserveScroll: true,
        onProgress: (progress) => {
            console.log(`Progresso: ${progress.percentage}%`);
        },
        onSuccess: (response) => {
            console.log(response);
            handleResponse(true);
        },
        onError: (errors) => {
            console.log(errors);
            handleResponse(true);
        }
    });
}

// atualiza as diretivas de variaveis conforme dados do backend
const handleResponse = (unexpected = false) => {
    let objResult = usePage().props.flash.objResult;
    if (objResult || unexpected) {
        const { object, type, message } = objResult ?? {};
        messageForm.object = object ?? null;
        messageForm.type = type ?? 'error';
        messageForm.message = message ?? 'Erro inesperado consulte o suporte.';
        messageForm.show = true;

        // exibe e oculta a mensagem apos um certo tempo, de modo que nao permite o tempo da mensagem anterior atrapalhar a exibicao do tempo da mensagem atual
        if (messageForm.timeOutMessage) clearTimeout(messageForm.timeOutMessage);
        messageForm.timeOutMessage = setTimeout(() => {
            messageForm.show = false;
        }, 15000);
    }
}

</script>