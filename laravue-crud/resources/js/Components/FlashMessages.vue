<template>
  <div class="fixed top-4 right-4 z-50 space-y-3" v-if="hasMessages">
    <!-- Mensagem de Sucesso -->
    <div 
      v-if="page.props.flash.success" 
      class="bg-green-50 border border-green-200 rounded-lg p-4 shadow-lg transition-all duration-300 transform animate-fade-in"
      role="alert"
    >
      <div class="flex items-start">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-green-800">
            Sucesso!
          </h3>
          <div class="mt-1 text-sm text-green-700">
            {{ page.props.flash.success }}
          </div>
        </div>
        <div class="ml-auto pl-3">
          <button 
            @click="clearMessage('success')" 
            class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600"
          >
            <span class="sr-only">Fechar</span>
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mensagem de Erro -->
    <div 
      v-if="page.props.flash.error" 
      class="bg-red-50 border border-red-200 rounded-lg p-4 shadow-lg transition-all duration-300 transform animate-fade-in"
      role="alert"
    >
      <div class="flex items-start">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-red-800">
            Erro!
          </h3>
          <div class="mt-1 text-sm text-red-700">
            {{ page.props.flash.error }}
          </div>
        </div>
        <div class="ml-auto pl-3">
          <button 
            @click="clearMessage('error')" 
            class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600"
          >
            <span class="sr-only">Fechar</span>
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mensagens de Validação -->
    <div 
      v-if="hasValidationErrors" 
      class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 shadow-lg transition-all duration-300 transform animate-fade-in"
      role="alert"
    >
      <div class="flex items-start">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="ml-3">
          <h3 class="text-sm font-medium text-yellow-800">
            Atenção!
          </h3>
          <div class="mt-2 text-sm text-yellow-700">
            <ul class="list-disc list-inside space-y-1">
              <li v-for="(error, field) in page.props.errors" :key="field">
                {{ error }}
              </li>
            </ul>
          </div>
        </div>
        <div class="ml-auto pl-3">
          <button 
            @click="clearValidationErrors" 
            class="inline-flex bg-yellow-50 rounded-md p-1.5 text-yellow-500 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600"
          >
            <span class="sr-only">Fechar</span>
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
import { computed, watch } from 'vue'

const page = usePage()

const hasMessages = computed(() => {
  return page.props.flash.success || 
         page.props.flash.error || 
         Object.keys(page.props.errors).length > 0
})

const hasValidationErrors = computed(() => {
  return Object.keys(page.props.errors).length > 0
})

// Auto-fechar mensagens após 5 segundos
watch(hasMessages, (newVal) => {
  if (newVal) {
    setTimeout(() => {
      clearAllMessages()
    }, 5000)
  }
})

const clearMessage = (type) => {
  page.props.flash[type] = null
}

const clearValidationErrors = () => {
  // Inertia não permite modificar props diretamente, então recarregamos a página
  // ou usamos uma abordagem alternativa
  window.location.reload()
}

const clearAllMessages = () => {
  page.props.flash.success = null
  page.props.flash.error = null
  // Para errors de validação, geralmente é melhor recarregar
  if (hasValidationErrors.value) {
    window.location.reload()
  }
}
</script>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>