<?php

namespace App\Http\Controllers;

use App\Helpers\MessageTools;
use App\Models\Address;
use App\Models\Client;
use App\Models\Sell;
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
        $clients = Client::with('address')->paginate(5);
//        $clients = Client::paginate(5); //Obtener los clientes paginados
        // $clients = Client::all(); // Suponiendo que estás utilizando el modelo Client para acceder a los datos de los clientes los coges a todos
        //        return view('clients.list', ['clients' => $clients]);
        return view('clients.list', compact('columns', 'clients'));
    }

//    public function search(Request $request)
//    {
//        $value = $request->query->get('search');
//        $clients = Client::where('dni', $value)->get();
//        $columns = Schema::getColumnListing('clients');
//        return view('clients.list', compact('columns', 'clients'));
//    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $search = $request->input('search');

        // Buscar clientes que tengan alguna dirección que coincida con el término de búsqueda
        $clients = Client::where('dni', $search) // Búsqueda por DNI en el cliente
        ->orWhereHas('address', function ($query) use ($search) {
            $query->where('address_name', 'like', "%$search%")
                ->orWhere('city', 'like', "%$search%")
                ->orWhere('postal_code', 'like', "%$search%")
                ->orWhere('country', 'like', "%$search%");
        })
            ->orWhere(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('surname', 'like', "%$search%")
                    ->orWhere('telephone_num', 'like', "%$search%")
                    ->orWhere('email_address', 'like', "%$search%");
            })
            ->paginate(5)->withQueryString();

        $columns = Schema::getColumnListing('clients');

        return view('clients.list', compact('columns', 'clients'))
            ->with('search', $search);
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
//            'address' => 'required',
            'address_name' => 'required', // address_name en lugar de address
            'city' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'email' => 'required|email',
        ]);

        // Empezamos una transacción para asegurar que ambos registros se guarden
        try {
            $client = new Client();
            $client->dni = $request->dni;
            $client->name = $request->name;
            $client->surname = $request->surname;
            $client->telephone_num = $request->telephone;
            $client->email_address = $request->email;
            $client->save();

            /* Tengo que tener el client creado que hace auto_increment y que despues con esto de
            abajo podrá saber a que id referenciarse */
            $client->address()->create([
                'address_name' => $request->address_name,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
            ]);

            /*$address = new Address();
            $address->client_id = $client->id;
            $address->address_name = $request->address_name;
            $address->city = $request->city;
            $address->postal_code = $request->postal_code;
            $address->country = $request->country;
            $address->save();*/


            $result = true;
        } catch (\Exception $e) {
            $result = false;
        }

        return redirect()->route('clients.list')
            ->with('result', MessageTools::generate($result,
                ['success' => 'Saved!', 'error' => 'Not saved!'],
                ['success' => 'Client added successfully!', 'error' => 'Failed!']
            ));
    }

    public function edit(Request $request, Client $client)
    {
        $data = $request->validate([
            'dni' => ['required', 'string', 'regex:/^\d{8}[a-zA-Z]$/'],
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'telephone_num' => 'required|string|max:255',
            'address_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'email_address' => 'required|string|email|max:255',
        ]);

         $result = $client->update($data);

        $method = $client->address()->count() > 0 ? 'update' : 'create';
        $client->address()->$method([
            'address_name' => $request->address_name,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        /*if ($client->address()->count() > 0) {
            $client->address()->update($address_data);
        } else {
            $client->address()->create($address_data);
        }*/

      // return redirect()->route('clients.list')->with('success', 'Cliente actualizado correctamente');

        return redirect()->route('clients.list')
            ->with('result', MessageTools::generate($result,
                ['success' => 'Updated!', 'error' => 'Not updated!'],
                ['success' => 'Clients updated successfully!', 'error' => 'Failed!']
            ));
    }


    public function delete(Client $client)
    {
        $result = $client->delete();
        // Redireccionar o realizar otras acciones según sea necesario
        // return redirect()->route('clients.list')->with('success', 'Cliente eliminado correctamente');
        return redirect()->route('clients.list')
            ->with('result', MessageTools::generate($result,
                ['success' => 'Deleted!', 'error' => 'Not deleted!'],
                ['success' => 'Clients deleted successfully!', 'error' => 'Failed!']
            ));
    }

}
