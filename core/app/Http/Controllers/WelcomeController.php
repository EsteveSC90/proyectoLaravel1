<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    public function index() {
        $var = [
            'hola', 'adios', 'buen dia'
        ];
        return view('welcomeproyect')->with('saludos', $var);
    }
}
