<template>
  <div v-if="show" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/3 shadow-lg rounded-md bg-white">
      <div class="text-center">
        <!-- Ícone -->
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
          <span class="text-red-600 text-xl">⚠️</span>
        </div>
        
        <!-- Conteúdo -->
        <h3 class="text-lg font-medium text-gray-900 mt-4">Confirmar Exclusão</h3>
        <p class="text-sm text-gray-500 mt-2">
          Tem certeza que deseja excluir o livro 
          <strong>"{{ livro?.titulo }}"</strong>? Esta ação não pode ser desfeita.
        </p>

        <!-- Botões -->
        <div class="flex justify-center space-x-3 mt-6">
          <button 
            @click="$emit('close')" 
            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
          >
            Cancelar
          </button>
          <button 
            @click="confirmDelete" 
            :disabled="form.processing" 
            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 disabled:opacity-50"
          >
            <span v-if="form.processing">Excluindo...</span>
            <span v-else>Sim, Excluir</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  show: Boolean,
  livro: Object
})

const emit = defineEmits(['close', 'deleted'])

const form = useForm({})

const confirmDelete = () => {
  form.delete(route('livros.destroy', { livro: props.livro.id }), {
    preserveScroll: true,
    onSuccess: () => {
      emit('deleted')
    }
  })
}
</script>