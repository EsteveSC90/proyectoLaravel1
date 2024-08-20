<?php

namespace App\Http\Controllers;

use App\Helpers\MessageTools;
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
        $data = $request->validate([
            'search' => 'required|string|max:255',
        ]);

        //dd($request->input('search')); // recupera del query param
        //dd($data); // recupera de la variable data

        //$search = $data['search'];
        $search = $request->input('search');

        $sellers = Seller::where('dni', $search)
            ->orWhere(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('surname', 'like', "%$search%")
                    ->orWhere('telephone_num', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%")
                    ->orWhere('email_address', 'like', "%$search%");
            })
        ->paginate(5)->withQueryString();

        $columns = Schema::getColumnListing('seller');
        return view('sellers.list', compact('columns', 'sellers', 'search'));
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


        try {
            $client = new Seller();
            $client->dni = $request->dni;
            $client->name = $request->name;
            $client->surname = $request->surname;
            $client->telephone_num = $request->telephone;
            $client->address = $request->address;
            $client->email_address = $request->email;
            $client->save();

            $result = true; // Asume que la creación fue exitosa
        } catch (\Exception $e) {
            $result = false;
        }

        return redirect()->route('sellers.list')
            ->with('result', MessageTools::generate($result,
                ['success' => 'Saved!', 'error' => 'Not saved!'],
                ['success' => 'Client added successfully!', 'error' => 'Failed!']
            ));
    }

    public function edit(Seller $seller, Request $request)
    {
        $data = $request->validate([
            'dni' => ['required', 'string', 'regex:/^\d{8}[a-zA-Z]$/'],
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'telephone_num' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email_address' => 'required|string|email|max:255',
        ]);

         $result = $seller->update($data);

        // Redireccionar o realizar otras acciones según sea necesario
        // return redirect()->route('sellers.list')->with('success', 'Cliente actualizado correctamente');

        return redirect()->route('sellers.list')
            ->with('result', MessageTools::generate($result,
                ['success' => 'Updated!', 'error' => 'Not updated!'],
                ['success' => 'Sellers updated successfully!', 'error' => 'Failed!']
            ));
    }

    public function delete(Seller $seller)
    {
        $result = $seller->delete();
        // Redireccionar o realizar otras acciones según sea necesario
        // return redirect()->route('sellers.list')->with('success', 'Cliente eliminado correctamente');
        return redirect()->route('sellers.list')
            ->with('result', MessageTools::generate($result,
                ['success' => 'Deleted!', 'error' => 'Not deleted!'],
                ['success' => 'Sellers deleted successfully!', 'error' => 'Failed!']
            ));
    }
}
