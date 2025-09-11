<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';


const login = useForm({
    email: '',
    password: '',
    remember: false,
});


/*
const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}
*/
</script>

<template>
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800"></h2>
        <button @click="$emit('close')" class="text-gray-500 hover:text-gray-700">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      
      <span class="text-blue-300">{{erro}}</span>
      <form @submit.prevent="login.post('/login')" class="space-y-4" >

        <div v-if="login.errors.mensagem" class="text-red-500 text-sm mt-1">
          {{ login.errors.mensagem }}
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
          <input 
            v-model="login.email"
            type="email" 
            id="email" 
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
          >
          <p v-if="$page.props.errors.email" class="mt-1 text-sm text-red-600">
            {{ $page.props.errors.email }}
          </p>
        </div>
        
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
          <input 
            v-model="login.password"
            type="password" 
            id="password" 
            
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
          >
          <p v-if="$page.props.errors.password" class="mt-1 text-sm text-red-600">
            {{ $page.props.errors.password }}
          </p>
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input 
              v-model="remember"
              id="remember-me" 
              name="remember-me" 
              type="checkbox"
              class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
            >
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">Lembrar de mim</label>
          </div>
       </div>
        
        <div class="flex items-center justify-between">
          <a href="#" class="text-sm text-blue-600 hover:text-blue-500">Esqueceu a senha?</a>
        </div>
        
        <div>
          <button 
            type="submit"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          >
            Entrar
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
