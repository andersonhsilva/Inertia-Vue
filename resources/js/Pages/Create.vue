<template>
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
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="5"
                placeholder="Digite o conteúdo do post"></textarea>
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

</template>

<script setup>
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';

defineOptions({
    name: 'Create'
});

const props = defineProps(['success']);

// Usando useForm para gerenciar os dados do formulário
const form = useForm({
    title: '',
    content: ''
});

// Método para submeter o formulário
const submitForm = () => {
    form.post(route('dashboard.store'), {
        onSuccess: (response) => {
            console.log(response);
            alert(props.success);
            // form.reset();
        },
        onError: (errors) => {
            console.log(errors);
            alert(errors.title ?? errors.content);
        }
    });
}
</script>