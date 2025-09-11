<template>
  <transition name="modal-fade">
    <div v-if="isOpen" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Cabeçalho -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
          <h3 class="text-xl font-semibold text-gray-900">Detalhes do Livro</h3>
          <button 
            @click="$emit('close')" 
            class="text-gray-400 hover:text-gray-600 transition-colors"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
             
        <!-- Corpo do Modal -->
        <div class="p-6" v-if="livro">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Capa do Livro -->
            <div class="md:col-span-1">
              <div class="bg-gray-200 rounded-lg w-full h-64 flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
              </div>
            </div>

            <!-- Informações do Livro -->
            <div class="md:col-span-2">
              <div class="space-y-4">

                <div class="flex items-center float-right mb-5">
                    <label class="block text-sm font-medium text-gray-500">{{ livro.user.name }}</label>
                    
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-500">Título</label>
                  <p class="mt-1 text-lg font-semibold text-gray-900">{{ livro.titulo }}</p>
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-500">Autor</label>
                  <p class="mt-1 text-gray-900">{{ livro.autor }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-500">Ano de Publicação</label>
                    <p class="mt-1 text-gray-900">{{ livro.ano_publicacao }}</p>
                  </div>
                  
                  <div>
                    <label class="block text-sm font-medium text-gray-500">Quantidade</label>
                    <p class="mt-1 text-gray-900">{{ livro.quantidade }} unidade(s)</p>
                  </div>

                </div>
                    
                <div>
                  <label class="block text-sm font-medium text-gray-500">Descrição</label>
                  <p class="mt-1 text-gray-900 font-mono whitespace-pre-wrap">{{ livro.descricao || 'Nenhuma descrição fornecida.' }}</p>
                </div>

                <div v-if="livro.created_at">
                  <label class="block text-sm font-medium text-gray-500">Data de Cadastro</label>
                  <p class="mt-1 text-gray-900">{{ formatarData(livro.created_at) }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Rodapé -->
        <div class="flex justify-end space-x-3 p-6 border-t border-gray-200">
          <button 
            @click="$emit('close')" 
            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors"
          >
            Fechar
          </button>

          <Link  style="display: none;"
            v-if="livro"
            :href="route('livros.edit', livro.id)" 
            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors"
          >
            Editar Livro
          </Link>


        </div>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  isOpen: {
    type: Boolean,
    required: true,
    default: false
  },
  livro: {
    type: Object,
    default: null
  }
})

const emit = defineEmits(['close'])

// Formatar data
const formatarData = (data) => {
  if (!data) return 'N/A'
  return new Date(data).toLocaleDateString('pt-BR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}

</script>

<style scoped>
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity 0.3s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
}
</style>