<template>
    <div class="container w-7xl mx-auto p-4 m-8 text-4xl text-white">


        <div v-if="$page.props.auth.user" style="display: none;">
            <div class="">
                <p>ID do usuário: {{ $page.props.auth.user.id }}</p>
                <p>Nome: {{ $page.props.auth.user.name }}</p>
            </div>
        </div>

        <div>
            <Texto />
            <div class="mt-4 text-2xl text-amber-700 flex gap-4 ">

                <div v-if="$page.props.auth.user">
                    <Link href="livraria">Entrar no sistema</Link>
                </div>

                <div class="" v-else>
                    <Link href="/login" class="bg-amber-50 p-2 border-0 rounded-2xl m-4">Logar</Link>

                    <Link href="/user/create" class="bg-amber-50 p-2 border-0 rounded-2xl">Criar conta</Link>
                </div>
                  
            </div>
        </div>

    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import Texto from '../Components/Texto.vue';

const nome = ref('Kelvin');


</script>

<style></style>