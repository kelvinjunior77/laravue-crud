<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    

    public function laravue()
    {
        return inertia('LaraVue');
    }

    
    public function livraria()
    {
        return inertia('Livraria');
    }
}
