<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class HomeController extends Controller
{
    

    public function laravue()
    {
        return inertia('LaraVue');
    }

    
    public function livraria()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

       $totalLivros = $user->livros()->count();
       $totalUsuarios = User::count();
        
        return inertia('Livraria', [
            'totalLivros' => $totalLivros,
            'totalUsuarios' => $totalUsuarios,
        ]);
    }
}
