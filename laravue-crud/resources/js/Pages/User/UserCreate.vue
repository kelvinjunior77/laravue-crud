<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
     
        <!-- Mensagens de feedback -->
      <div v-if="message" class="mb-4 p-4 rounded-lg" :class="messageType === 'success' ? 'bg-green-50 text-green-800' : 'bg-red-50 text-red-800'">
        <div class="flex">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path v-if="messageType === 'success'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          {{ message }}
        </div>
      </div>

      <!-- Cabeçalho -->
      <div class="text-center mb-8" style="display: none;">
        <h1 class="text-3xl font-bold text-gray-900">Criar Conta</h1>
        <p class="text-gray-600 mt-2">Junte-se ao LaraVue e comece a gerenciar seus livros</p>
      </div>

      <!-- Formulário de Cadastro -->
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 sm:p-8">
          <form @submit.prevent="submit" class="space-y-6">
            <!-- Nome Completo -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                Nome Completo <span class="text-red-500">*</span>
              </label>
              <input
                id="name"
                v-model="form.name"
                type="text"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none  focus:border-blue-500 focus:border-2"
                placeholder="Digite seu nome completo"
              >
              <p v-if="errors.name" class="mt-1 text-sm text-red-600">{{ errors.name }}</p>
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                Email <span class="text-red-500">*</span>
              </label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none  focus:border-blue-500 focus:border-2"
                placeholder="seu@email.com"
              >
              <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email }}</p>
            </div>

            <!-- Senha -->
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                Senha <span class="text-red-500">*</span>
              </label>
              <input
                id="password"
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none  focus:border-blue-500 focus:border-2"
                placeholder="Crie uma senha segura"
              >
              <div class="flex items-center mt-2">
                <button
                  type="button"
                  @click="showPassword = !showPassword"
                  class="flex items-center text-sm text-gray-600 hover:text-gray-800"
                >
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path v-if="showPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                    <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  {{ showPassword ? 'Ocultar' : 'Mostrar' }} senha
                </button>
              </div>
              <p v-if="errors.password" class="mt-1 text-sm text-red-600">{{ errors.password }}</p>
            </div>

            <!-- Confirmar Senha -->
            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                Confirmar Senha <span class="text-red-500">*</span>
              </label>
              <input
                id="password_confirmation"
                v-model="form.password_confirmation"
                type="password"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none  focus:border-blue-500 focus:border-2"
                placeholder="Confirme sua senha"
              >
              <p v-if="errors.password_confirmation" class="mt-1 text-sm text-red-600">{{ errors.password_confirmation }}</p>
            </div>

            <!-- Termos e Condições -->
            <div class="flex items-center">
              <input
                id="terms"
                v-model="form.terms"
                type="checkbox"
                required
                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
              >
              <label for="terms" class="ml-2 block text-sm text-gray-700">
                Eu concordo com os <a href="#" class="text-indigo-600 hover:text-indigo-800">termos e condições</a>
                e <a href="#" class="text-indigo-600 hover:text-indigo-800">política de privacidade</a>
              </label>
            </div>

            <!-- Botão de Submit -->
            <button
              type="submit"
              :disabled="loading"
              class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
            >
              <span v-if="loading" class="flex items-center justify-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Criando conta...
              </span>
              <span v-else>Criar Conta</span>
            </button>
          </form>

          <!-- Divisor -->
          <div class="mt-6 pt-6 border-t border-gray-200">
            <p class="text-center text-sm text-gray-600">
              Já tem uma conta?
              <a href="/login" class="font-medium text-indigo-600 hover:text-indigo-500 ml-1">
                Faça login aqui
              </a>
            </p>
          </div>
        </div>
      </div>

      
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useForm } from '@inertiajs/vue3'

// Estados do formulário
const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false
})

// Estados de UI
const showPassword = ref(false)
const loading = ref(false)
const message = ref('')
const messageType = ref('') // 'success' or 'error'

// Erros de validação
const errors = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

// Função para validar o formulário
const validateForm = () => {
  let isValid = true
  
  // Reset errors
  Object.keys(errors).forEach(key => errors[key] = '')
  
  // Validar nome
  if (!form.name.trim()) {
    errors.name = 'O nome é obrigatório'
    isValid = false
  }
  
  // Validar email
  if (!form.email.trim()) {
    errors.email = 'O email é obrigatório'
    isValid = false
  } else if (!/\S+@\S+\.\S+/.test(form.email)) {
    errors.email = 'Email inválido'
    isValid = false
  }
  
  // Validar senha
  if (!form.password) {
    errors.password = 'A senha é obrigatória'
    isValid = false
  } else if (form.password.length < 6) {
    errors.password = 'A senha deve ter pelo menos 6 caracteres'
    isValid = false
  }
  
  // Validar confirmação de senha
  if (form.password !== form.password_confirmation) {
    errors.password_confirmation = 'As senhas não coincidem'
    isValid = false
  }
  
  // Validar termos
  if (!form.terms) {
    message.value = 'Você deve aceitar os termos e condições'
    messageType.value = 'error'
    isValid = false
  }
  
  return isValid
}

// Função para simular o envio do formulário
const handleSubmit = async () => {
  if (!validateForm()) return
  
  loading.value = true
  message.value = ''
  
  try {
    // Simular uma requisição assíncrona
    await new Promise(resolve => setTimeout(resolve, 1500))
    
    // Simular sucesso no cadastro
    message.value = 'Conta criada com sucesso! Redirecionando...'
    messageType.value = 'success'
    
    // Simular redirecionamento
    setTimeout(() => {
      // Aqui você redirecionaria para a página de login ou dashboard
      console.log('Redirecionando...')
    }, 2000)
    
  } catch (error) {
    message.value = 'Erro ao criar conta. Tente novamente.'
    messageType.value = 'error'
  } finally {
    loading.value = false
  }
}


const submit = () => {
  form.post(route('users.store'))
}

</script>

<style scoped>
/* Estilos específicos do componente */
.form-input:focus {
  outline: none;
  box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
}
</style>