<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Seller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SellerController extends Controller
{

//    public function vista()
//    {
//        return view('clients.list');
//    }



    public function list()
    {
        $columns = Schema::getColumnListing('sellers');
        // $sellers = Seller::all(); // Obtener todos los vendedores
        $sellers = Seller::paginate(5); //Obtener los vendedores paginados
        // return view('sellers.list', ['sellers' => $sellers]);
        return view('sellers.list', compact('columns', 'sellers'));
    }

    public function search(Request $request)
    {
        $value = $request->query->get('search');
        $sellers = Seller::where('dni', $value)->get();
        $columns = Schema::getColumnListing('seller');
        return view('sellers.list', compact('columns', 'sellers'));
    }

    public function get($id)
    {
        $seller = Seller::findOrFail($id); // Suponiendo que estás utilizando el modelo Client para acceder a los datos del cliente
        return view('sellers.show', compact('seller'));
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

        $client = new Seller();
        $client->dni = $request->dni;
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->telephone_num = $request->telephone;
        $client->address = $request->address;
        $client->email_address = $request->email;
        $client->save();

        return redirect()->route('sellers.list')
            ->with('success', 'Client added successfully!');
    }

    public function edit(Seller $seller, Request $request)
    {
        $data = $request->validate([
            'dni' => ['required', 'string', 'regex:/^\d{8}[a-zA-Z]$/'],
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $seller->update($data);

        // Redireccionar o realizar otras acciones según sea necesario
        return redirect()->route('sellers.list')->with('success', 'Cliente actualizado correctamente');
    }

    public function delete(Seller $seller)
    {
        $seller->delete();
        // Redireccionar o realizar otras acciones según sea necesario
        return redirect()->route('sellers.list')->with('success', 'Cliente eliminado correctamente');
    }
}
