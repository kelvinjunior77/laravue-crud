<template>

    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 mb-8">
        <div class="text-center">
            <h1 class="text-4xl font-semibold text-indigo-700 mb-4"><span class="text-red-600">Lara</span>Vue</h1>
            <p class="text-xl text-gray-700 mb-6">Sistema CRUD Moderno - Laravel 12 + Vue 3 + Inertia</p>


            <div class="flex flex-wrap gap-3 justify-center">

                <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Laravel 12
                </span>
                <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Vue 3
                </span>
                <span
                    class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-sm font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Inertia.js
                </span>

                <span class="text-cyan-800 bg-cyan-100 px-4 py-2 rounded-full text-sm font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Tailwind CSS 4
                </span>
            </div>

        </div>
    </div>



    <!-- Seção Sobre o Projeto -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
        <div class="p-8">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Sobre o Projeto</h2>
            </div>

            <div class="prose prose-lg max-w-none text-gray-700">
                <p class="text-lg leading-relaxed">
                    <span class="font-semibold text-indigo-700" style="display: none;">LaraVue</span> É um sistema CRUD
                    completo desenvolvido para
                    gerenciamento de livros, representando a poderosa integração entre
                    <span class="font-semibold text-red-600">Laravel 12</span> e <span
                        class="font-semibold text-green-800">Vue 3</span>
                    através do <span class="font-semibold text-purple-600">Inertia.js</span>.
                    Este projeto nasceu da necessidade de demonstrar como essas tecnologias podem trabalhar em
                    perfeita harmonia, eliminando a complexidade tradicional de APIs REST separadas.
                </p>


                <p class="text-lg leading-relaxed">
                    Este projeto - é uma demonstração prática do que é possível
                    alcançar quando unimos o melhor do backend Laravel com o frontend Vue. Um projeto inspirador para
                    developers que buscam evoluir sua stack e dominar uma das combinações mais poderosas do
                    desenvolvimento web moderno.

                   <span class="" style="font-size: 16px;">"Dominar Laravel e Vue não é sobre aprender duas tecnologias, mas sim sobre dominar uma única stack
                    poderosa."</span>  
                </p>
            </div>
        </div>



    </div>






</template>

<script setup>
// Lógica do componente (se necessário)
</script>

<style scoped>
/* Estilos específicos do componente */
.prose p {
    margin-bottom: 1rem;
    line-height: 1.7;
}
</style>