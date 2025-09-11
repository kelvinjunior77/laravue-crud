<template>
    <Dashboard />

    <Head title="Lista de Livros"></Head>

    <div class="container max-w-6xl mx-auto px-4 py-8">
        <!-- Lista de Livros -->


        <div class="bg-white shadow-md rounded-lg overflow-hidden">

            <div class="p-4 flex items-center">
                <input type="text" placeholder="Pesquisar por título ou autor..."
                    class="mb-4 w-full px-4 py-2 border-0 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 border-b-blue-900"
                    v-model="form.search" @keyup.enter="buscar" />

                <button @click="buscar"
                    class="ml-2 mb-4 p-80 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-300 cursor-pointer">
                    Pesquisar
                </button>


                <!-- Lista de sugestões 
                    <ul
                    v-if="sugestoes.length > 0"
                    class="absolute bg-white border rounded-lg mt-1 w-full shadow-lg z-10"
                    >
                    <li
                        v-for="livro in sugestoes"
                        :key="livro.id"
                        @click="selecionarLivro(livro)"
                        class="px-3 py-2 hover:bg-gray-100 cursor-pointer"
                    >
                        {{ livro.titulo }}
                    </li>
                    </ul>-->

            </div>

            <div v-if="livros.data.length">
                <table class="min-w-full">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Título</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Autor
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ano
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantidade
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="livro in livros.data" :key="livro.id">
                            <td class="px-6 py-4 whitespace-nowrap">{{ livro.titulo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ livro.autor }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ livro.ano_publicacao }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ livro.quantidade }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <!-- Botão Editar 
              :href="route('livros.edit', { livro: livro.id })"
                            <Link :href="route('livros.edit', { livro: livro.id })" 
 class="text-indigo-600 hover:text-indigo-900 mr-3">
                            Editar
                            </Link> -->
                                <button @click="abrirModal(livro)" class="text-green-600 hover:text-green-900 mr-3">
                                    Ver
                                </button>
                                <button @click.prevent="editar(livro.id)"
                                    class="bg-indigo-200 rounded-3xl p-2 text-indigo-600 hover:text-indigo-900 mr-3 cursor-pointer">
                                    Editar
                                </button>


                                <!-- Botão Excluir -->
                                <button @click="abrirModalExclusao(livro)"
                                    class="bg-red-200 p-2 rounded-3xl text-sm cursor-pointer text-red-600 hover:text-red-900">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else class="text-gray-500 text-center py-8">
                Nenhum livro encontrado.
            </div>

        </div>



        <!-- Paginação -->
        <div class="flex space-x-2 mt-4">

            <Link v-for="link in livros.links" :key="link.label" v-html="link.label" :disabled="!link.url"
                @click.prevent="mudarPagina(link.url)" class="px-3 py-1 border rounded" :class="{
                    'bg-blue-600 text-white': link.active,
                    'bg-gray-600 text-gray-400 pointer-events-none': !link.url
                }" />

        </div>


        <!-- Modal de Exclusão com Transição -->
        <transition name="fade">
            <div v-if="modalExclusaoAberto"
                class="fixed inset-0 z-50 flex justify-center items-start bg-gray-60 bg-opacity-50">
                <div class="bg-white rounded-xl shadow-lg w-full max-w-lg mx-4 mt-20 p-6 relative">
                    <!-- Título -->
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Confirmar Exclusão
                    </h3>

                    <!-- Texto -->
                    <p class="text-gray-700 mb-6">
                        Tem certeza que deseja excluir o livro <br>
                        <span class="text-red-600 font-bold">{{ livroSelecionado?.titulo }}?</span>
                    </p>

                    <!-- Divider -->
                    <hr class="mb-6">

                    <!-- Ações -->
                    <div class="flex justify-end space-x-3">
                        <button @click="fecharModalExclusao"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                            Cancelar
                        </button>

                        <button @click="excluirLivro" :disabled="excluindo"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 disabled:opacity-50 transition">
                            <span v-if="excluindo">Excluindo...</span>
                            <span v-else>Confirmar Exclusão</span>
                        </button>
                    </div>
                </div>
            </div>
        </transition>

    </div>

    <!-- Modal de Detalhes do Livro (Componente) -->
    <LivroModal :is-open="modalDetalhesAberto" :livro="livroSelecionado" @close="fecharModalDetalhes" />

</template>
<script setup>
import { Link, router, Head } from '@inertiajs/vue3'
import Dashboard from '../Dashboard.vue'
import { ref, reactive } from 'vue'
import LivroModal from '../../Components/LivroModal.vue'


const props = defineProps({
    livros: Object,
    filters: Object,
})

const form = reactive({
    search: props.filters?.search || "",
})

// Dispara busca
function buscar() {
    router.get(route("livro.lista"), form, {
        preserveState: true,
        replace: true,
    })
}

// Paginação com busca
function mudarPagina(url) {
    router.visit(url, {
        preserveState: true,
        replace: true,
    })
}

const excluindo = ref(false)
// Estados dos modais
const modalDetalhesAberto = ref(false)
const modalExclusaoAberto = ref(false)
const livroSelecionado = ref(null)

// Abrir modal de detalhes
const abrirModal = (livro) => {
    livroSelecionado.value = livro
    modalDetalhesAberto.value = true
}

// Abrir modal de exclusão
const abrirModalExclusao = (livro) => {
    livroSelecionado.value = livro
    modalExclusaoAberto.value = true
}

// Fechar modal de detalhes
const fecharModalDetalhes = () => {
    modalDetalhesAberto.value = false
    livroSelecionado.value = null
}

// Fechar modal de exclusão
const fecharModalExclusao = () => {
    modalExclusaoAberto.value = false
    livroSelecionado.value = null
}

// Excluir
const excluirLivro = () => {
    if (!livroSelecionado.value) return
    excluindo.value = true

    router.delete(route('livro.destroy', { livro: livroSelecionado.value.id }), {
        preserveScroll: true,
        onSuccess: () => {
            fecharModalExclusao()
        },
        onError: (errors) => {
            console.error('Erro ao excluir:', errors)
            alert('Erro ao excluir livro. Tente novamente.')
        },
        onFinish: () => {
            excluindo.value = false
        },
    })
}

function editar(id) {
    router.get('/livro/' + id + '/edit');
}
</script>

<style scoped>
/* Efeito de fade-in com lentidão */
.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(-20px);
}
</style>