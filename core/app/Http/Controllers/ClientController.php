<?php

namespace App\Http\Controllers;

use App\Helpers\MessageTools;
use App\Models\Client;
use App\Models\Seller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ClientController extends Controller
{

    /**
     *
     * function index => punto de entrada
     * function list => listado
     * function get => item concreto
     *
     * function add => añadir un registro
     * function edit => editar un registro
     * function delete => eliminar un registro
     *
     **/





//    public function vista()
//    {
//        return view('clients.list');
//    }

    public function list()
    {
        $columns = Schema::getColumnListing('clients');
        $clients = Client::all(); // Suponiendo que estás utilizando el modelo Client para acceder a los datos de los clientes
//        return view('clients.list', ['clients' => $clients]);
        return view('clients.list', compact('columns', 'clients'));
    }

    public function search(Request $request)
    {
        $value = $request->query->get('search');
        $clients = Client::where('dni', $value)->get();
        $columns = Schema::getColumnListing('clients');
        return view('clients.list', compact('columns', 'clients'));
    }

    public function get($id)
    {
        $columns = Schema::getColumnListing('clients');
        $client = Client::findOrFail($id); // Suponiendo que estás utilizando el modelo Client para acceder a los datos del cliente
        return view('clients.show', compact('columns', 'client'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'dni' => ['required', 'string', 'regex:/^\d{8}[a-zA-Z]$/'],
            'name' => 'required',
            'surname' => 'required',
            'telephone' => 'required',
            'address' => 'required',
            'email' => 'required|email',
        ]);

        $client = new Client();
        $client->dni = $request->dni;
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->telephone_num = $request->telephone;
        $client->address = $request->address;
        $client->email_address = $request->email;
        $result = $client->save();

        return redirect()->route('clients.list')
            ->with('result', MessageTools::generate($result,
                ['success' => 'Saved!', 'error' => 'Not saved!'],
                ['success' => 'Client added successfully!', 'error' => 'Failed!']
            ));
    }

    public function edit(Client $client, Request $request)
    {
        $data = $request->validate([
            'dni' => ['required', 'string', 'regex:/^\d{8}[a-zA-Z]$/'],
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $client->update($data);

        // Redireccionar o realizar otras acciones según sea necesario
        return redirect()->route('clients.list')->with('success', 'Cliente actualizado correctamente');
    }

    public function delete(Client $client)
    {
        $client->delete();
        // Redireccionar o realizar otras acciones según sea necesario
        return redirect()->route('clients.list')->with('success', 'Cliente eliminado correctamente');
    }

}
