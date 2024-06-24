<?php

namespace App\Http\Controllers;

use App\Helpers\MessageTools;
use App\Models\Client;
use App\Models\Sell;
use App\Models\Seller;
use App\Models\SellLines;
use App\Models\Vehicle;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class SellsController extends Controller
{
    public function list()
    {
        $sells = Sell::paginate(15);
        $clients = Client::all();
        $sellers = Seller::all();
        $vehicles = Vehicle::all();
        return view('sells.list', compact('sells', 'clients', 'sellers', 'vehicles'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $clients = Client::all();
        $sellers = Seller::all();
        $vehicles = Vehicle::all();

        $sells = Sell::select('sells.*')
            ->join('clients', 'sells.client_id', '=', 'clients.id')
            ->join('sellers', 'sells.seller_id', '=', 'sellers.id')
            ->where(function ($query) use ($search) {
                $query->where('clients.dni', 'like', "%$search%")
                    ->orWhere('clients.name', 'like', "%$search%")
                    ->orWhere('clients.surname', 'like', "%$search%")
                    ->orWhere('clients.telephone_num', 'like', "%$search%")
                    ->orWhere('clients.email_address', 'like', "%$search%")
                    ->orWhere('sellers.dni', 'like', "%$search%")
                    ->orWhere('sellers.name', 'like', "%$search%")
                    ->orWhere('sellers.surname', 'like', "%$search%")
                    ->orWhere('sellers.telephone_num', 'like', "%$search%")
                    ->orWhere('sellers.email_address', 'like', "%$search%");
            })
            ->orWhereHas('lines', function ($query) use ($search) {
                $query->whereHas('vehicle', function ($query) use ($search) {
                    $query->where('registration', 'like', "%$search%");
                });
            })
            ->paginate(15);

        return view('sells.list', compact('sells', 'clients', 'sellers', 'vehicles'));
    }

    public function get(Sell $sell)
    {
        $lines = $sell->lines()->get();
        return view('sells.show', compact('lines'));
    }

    public function add(Request $request)
    {
        // Recuperamos los datos del formulario
        $data = $request->validate([
            'seller_id' => 'required',
            'client_id' => 'required',
            'quantity' => 'required',
            'vehicle_id' => 'required',
        ]);

        // Creación de la venta (cabecera)
        $sell = Sell::create($data);

        // Formateo de las líneas vehículo => cantidad
        $lines = [];
        foreach ($data['vehicle_id'] as $key => $v) {
            $lines[$v] = $data['quantity'][$key];
        }

        // Recorremos las líneas en formato vehículo => cantidad
        foreach ($lines as $vehicle_id => $quantity) {
            // Recuperación del objeto vehículo
            $vehicle = Vehicle::find($vehicle_id);

            $sell->lines()->create([
                'vehicle_id' => $vehicle->id, // ID del vehículo seleccionado
                'unit_price' => $vehicle->price, // Precio del vehículo
                'quantity' => $quantity, // Cantidad (formulario)
                'total_price' => $vehicle->price * $quantity // Total de la línea (precio * cantidad)
            ]);

            // Creación de cada línea de venta
            /*SellLines::create([
                'sell_id' => $sell->id, // ID de la venta creada
                'vehicle_id' => $vehicle->id, // ID del vehículo seleccionado
                'unit_price' => $vehicle->price, // Precio del vehículo
                'quantity' => $quantity, // Cantidad (formulario)
                'total_price' => $vehicle->price * $quantity // Total de la línea (precio * cantidad)
            ]);*/
        }

        return redirect()->route('sells.list')
            ->with('result', MessageTools::generate(true,
                ['success' => 'Saved!', 'error' => 'Not saved!'],
                ['success' => 'Sell added successfully!', 'error' => 'Failed!']
            ));
    }

    public function edit(Sell $sell, Request $request)
    {

    }

    public function delete(Sell $sell)
    {
        $sell->delete();
        return view('sells.show');
    }

}
