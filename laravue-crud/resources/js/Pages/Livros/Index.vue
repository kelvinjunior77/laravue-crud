<template>
  <div class="container mx-auto p-4">

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
       <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ano</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
          </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="livro in livros" :key="livro.id" class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">{{ livro.titulo }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ livro.autor }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ livro.ano_publicacao }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ livro.quantidade }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

              <Link 
               
                class="text-indigo-600 hover:text-indigo-900 mr-3"
              >
                Editar
              </Link>

              <!-- Botão Excluir -->
              <button 
                @click="abrirModal(livro)" 
                class="text-red-600 hover:text-red-900"
              >
                Excluir
              </button>
            </td>
          </tr>
        </tbody>

      </table>
    </div>
   



       <!-- Modal de Exclusão -->
    <div v-if="modalAberto" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
      <div class="bg-white rounded-lg shadow-xl p-6 w-96">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Confirmar Exclusão</h3>
        
        <p class="text-gray-600 mb-6">
          Tem certeza que deseja excluir o livro "{{ livroSelecionado?.titulo }}"?
        </p>

        <div class="flex justify-end space-x-3">
          <!-- Botão Cancelar -->
          <button 
            @click="fecharModal" 
            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400"
          >
            Cancelar
          </button>
          
          <!-- Botão Confirmar -->
          <button 
            @click="excluirLivro" 
            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
          >
            Confirmar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3'

const props = defineProps({

  livros: {
    type: Array,
    required: true
  }
  
})

// Estado do modal
const modalAberto = ref(false)
const livroSelecionado = ref(null)

// Abrir modal
const abrirModal = (livro) => {
  livroSelecionado.value = livro
  modalAberto.value = true
}

// Fechar modal
const fecharModal = () => {
  modalAberto.value = false
  livroSelecionado.value = null
}

// Excluir livro
const excluirLivro = () => {
  if (livroSelecionado.value) {
    // Implementar a exclusão aqui
    console.log('Excluindo livro:', livroSelecionado.value.id)
    fecharModal()
  }
}
</script>