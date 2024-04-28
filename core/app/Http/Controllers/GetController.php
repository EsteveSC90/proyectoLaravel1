<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Seller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class GetController extends Controller
{

//    public function vista()
//    {
//        return view('clients.list');
//    }

    public function seeClients()
    {
        $columns = Schema::getColumnListing('clients');
        $clients = Client::all(); // Suponiendo que estás utilizando el modelo Client para acceder a los datos de los clientes
//        return view('clients.list', ['clients' => $clients]);
        return view('clients.list', compact('columns', 'clients'));
    }

    public function seeSellers()
    {
        $columns = Schema::getColumnListing('sellers');
        $sellers = Seller::all();
        // return view('sellers.list', ['sellers' => $sellers]);
        return view('sellers.list', compact('columns', 'sellers'));
    }

    public function seeVehicles()
    {

        $columns = Schema::getColumnListing('vehicles');
        $vehicles = Vehicle::all();
        // return view('vehicles.list', ['vehicles' => $vehicles]);
        return view('vehicles.list', compact('columns', 'vehicles'));
    }
}
