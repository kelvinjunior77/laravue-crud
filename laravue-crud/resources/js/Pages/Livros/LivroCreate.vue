<script setup>
import { ref } from 'vue';
import { useForm, Head } from '@inertiajs/vue3';
import Dashboard from '../Dashboard.vue';

const ano = ref('')
const erro = ref('')

const validarAno = () => {
    const anoAtual = new Date().getFullYear()

    if (ano.value === '') {
        erro.value = ''
        return
    }

    const anoNum = parseInt(ano.value)

    if (isNaN(anoNum)) {
        erro.value = 'Digite um ano válido'
        return
    }

    if (anoNum < 1900 || anoNum > anoAtual) {
        erro.value = `Ano deve estar entre 1900 e ${anoAtual}`
    } else {
        erro.value = ''
    }
}
// Estados do formulário
const form = useForm({
    titulo: '',
    autor: '',
    ano_publicacao: '',
    quantidade: 1,
    descricao: ''
});



// Limpar formulário
const resetForm = () => {
    form.titulo = '';
    form.autor = '';
    form.ano_publicacao = '';
    form.quantidade = 1;
    form.descricao = '';
};


</script>

<template>
    <Dashboard></Dashboard>
    <Head title="Cadastrar Livro"></Head>

    <div class="w-full max-w-3/4  mx-auto bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4 mt-10">
        <!---<h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Cadastrar Livro</h2>--->

        <div v-if="$page.props.flash.success" class="p-4 mb-10 mt-4 text-sm text-green-900 rounded-lg bg-green-200 "
            role="alert">
            <span class="font-medium">{{ $page.props.flash.success }}</span> Agora podes gerenciar o livro.
        </div>

        <div v-if="form.errors.mensagem" class="p-4 mb-10 mt-4 text-sm text-red-900 rounded-lg bg-red-200 "
            role="alert">
            <span class="font-medium">{{ form.errors.mensagem }}!</span> Tenta novamente.
        </div>

        <form @submit.prevent="form.post('/livro')" class="space-y-4">
            <!-- Dados Pessoais -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Titulo -->
                <div>
                    <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Titulo *</label>
                    <input v-model="form.titulo" id="titulo" type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"
                        placeholder="Digite nome do autor">

                    <p v-if="$page.props.errors.titulo" class="mt-1 text-sm text-red-600">
                        {{ $page.props.errors.titulo }}
                    </p>
                </div>

                <!-- Autor -->
                <div>
                    <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Autor *</label>
                    <input v-model="form.autor" id="autor" type="text"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"
                        placeholder="Autor do livro">
                </div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- ano  -->
                <div>
                    <label for="cpf" class="block text-gray-700 text-sm font-bold mb-2">Ano de lançamento *</label>
                    <input v-model="form.ano_publicacao" id="ano_publicacao" type="number" min="1900"
                        :max="new Date().getFullYear()" placeholder="Ex: 2024" @input="validarAno"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500">
                    <p v-if="erro" class="text-red-500 text-sm">{{ erro }}</p>
                </div>

                <!-- Quantidade -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Quantidade *</label>
                    <div class="flex space-x-4">
                        <input v-model="form.quantidade" id="quantidade" min="1" type="number"
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

                    <textarea name="descricao" id="descricao" v-model="form.descricao" rows="3"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 mb-4"
                        placeholder="Descrição do livro">

          </textarea>

                </div>

            </div>

            <!-- Botões -->
            <div class="flex items-center justify-between mt-8">
                <button type="button" @click="resetForm"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Limpar
                </button>

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
                        Cadastrar
                    </span>
                </button>
            </div>
        </form>
    </div>
</template>


<style scoped>
.form-radio:checked {
    background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
}

.form-checkbox:checked {
    background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
}
</style>
