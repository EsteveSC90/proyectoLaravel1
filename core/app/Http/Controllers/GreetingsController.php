<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class GreetingsController extends Controller
{
    //
    public function hello($mensaje, $mensaje2 = null)
    {
        //$mensaje = 'Hola desde el controlador!';

        return view('prueba2', [
                'mensaje' => $mensaje,
                'mensaje2' => $mensaje2
            ]
        );
    }

    public function vista()
    {
        $clients = Client::all(); // Suponiendo que estás utilizando el modelo Client para acceder a los datos de los clientes
        return view('clients.list', ['clients' => $clients]);
    }
}
