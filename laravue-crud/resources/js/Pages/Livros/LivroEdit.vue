<template>
    <Dashboard />


    <div class="w-full max-w-3/4  mx-auto bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4 mt-10">
        <!---<h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Cadastrar Livro</h2>--->

        <div v-if="flash.success" class="p-4 mb-10 mt-4 text-sm text-green-900 rounded-lg bg-green-200 " role="alert">
            <span class="font-medium">{{ flash.success }}</span> Agora podes gerenciar o livro.
        </div>

        <div v-if="errors.mensagem" class="p-4 mb-10 mt-4 text-sm text-red-900 rounded-lg bg-red-200 " role="alert">
            <span class="font-medium">{{ errors.mensagem }}!</span> Tenta novamente.
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <!-- Dados Pessoais -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Titulo -->
                <div>
                    <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Titulo *</label>
                    <input v-model="livro.titulo" id="titulo" type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"
                        placeholder="Digite nome do autor">

                    <p v-if="props.errors.titulo" class="mt-1 text-sm text-red-600">
                        {{ props.errors.titulo }}
                    </p>
                </div>

                <!-- Autor -->
                <div>
                    <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Autor *</label>
                    <input v-model="livro.autor" id="autor" type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"
                        placeholder="Autor do livro">
                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- ano  -->
                <div>
                    <label for="cpf" class="block text-gray-700 text-sm font-bold mb-2">Ano de lançamento *</label>
                    <input v-model="livro.ano_publicacao" id="ano_publicacao" type="number" min="1900"
                        :max="new Date().getFullYear()" placeholder="Ex: 2024" @input="validarAno"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500">
                    <p v-if="erro" class="text-red-500 text-sm">{{ erro }}</p>
                </div>

                <!-- Quantidade -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Quantidade *</label>
                    <div class="flex space-x-4">
                        <input v-model="livro.quantidade" id="quantidade" min="1" type="number"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"
                            placeholder="Quantidade">
                    </div>
                </div>
            </div>

            <!-- Contato -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Descrição *</label>

                    <textarea name="descricao" id="descricao" v-model="livro.descricao" rows="3"
                        class="shadow appearance-none border rounded w-full m   py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 mb-4"
                        placeholder="Descrição do livro">

          </textarea>

                </div>

            </div>

            <!-- Botões -->
            <div class="flex items-center justify-between mt-8">
                <Link href="/livros"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Cancelar
                </Link>

                <button type="submit"
                    class="bg-blue-500 cursor-pointer ml-3 w-full hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    :disabled="isSubmitting">
                    <span v-if="isSubmitting">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Enviando...
                    </span>
                    <span v-else>
                        Salvar Alterações
                    </span>
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import Dashboard from '../Dashboard.vue';

const props = defineProps({
    livros: {
        type: Object,
        required: true,
        default: () => ({})
    },

    flash: {
        type: Object,
        default: () => ({ success: null, error: null })
    },

    errors: {
        type: Object,
        default: () => ({})
    },
})

const livro = useForm(props.livros);

const submit = () => {
    livro.put(route("livro.update", livro.id), {
        onSuccess: () => {
            console.log('sucesso')
        },
    });
};

</script>


<style scoped>
input {
    border: 2px solid rgb(39, 8, 101);
    font-weight: 200;
}
</style>