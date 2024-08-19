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
use mysql_xdevapi\Collection;

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
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

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
        $clients = Client::all();
        $sellers = Seller::all();
        return view('sells.show', compact('sell', 'sellers', 'clients'));
    }

//    public function add(Request $request)
//    {
//        // Recuperamos los datos del formulario
//        $data = $request->validate([
//            'seller_id' => 'required',
//            'client_id' => 'required',
//            'quantity' => 'required',
//            'vehicle_id' => 'required',
//        ]);
//
//        // Creación de la venta (cabecera)
//        $sell = Sell::create($data);
//
//        // Formateo de las líneas vehículo => cantidad
//        $lines = [];
//        foreach ($data['vehicle_id'] as $key => $v) {
//            $lines[$v] = $data['quantity'][$key];
//        }
//
//        if ($sell) {
//            $results = collect();
//            // Recorremos las líneas en formato vehículo => cantidad
//            foreach ($lines as $vehicle_id => $quantity) {
//                // Recuperación del objeto vehículo
//                $vehicle = Vehicle::find($vehicle_id);
//
//                $res = $sell->lines()->create([
//                    'vehicle_id' => $vehicle->id, // ID del vehículo seleccionado
//                    'unit_price' => $vehicle->price, // Precio del vehículo
//                    'quantity' => $quantity, // Cantidad (formulario)
//                    'total_price' => $vehicle->price * $quantity // Total de la línea (precio * cantidad)
//                ]);
//
//                $results->add($res);
//
//
//            }
//        }
//
//        $status = $sell && !$results->has(false);
//
//        return redirect()->route('sells.list')
//            ->with('result', MessageTools::generate($status,
//                ['success' => 'Saved!', 'error' => 'Not saved!'],
//                ['success' => 'Sell added successfully!', 'error' => 'Failed!']
//            ));
//    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'seller_id' => 'required',
            'client_id' => 'required',
            'quantity' => 'required|array',
            'vehicle_id' => 'required|array',
        ]);

        $sell = Sell::create($data);
        \Log::info('Venta creada:', ['sell' => $sell !== null]);

        $lines = [];
        foreach ($data['vehicle_id'] as $key => $v) {
            $lines[$v] = $data['quantity'][$key];
        }

        if ($sell) {
            $results = collect();

            foreach ($lines as $vehicle_id => $quantity) {
                $vehicle = Vehicle::find($vehicle_id);

                if (!$vehicle) {
                    \Log::error("Vehicle with ID $vehicle_id not found.");
                    $results->add(false);
                    continue;
                }

                $res = $sell->lines()->create([
                    'vehicle_id' => $vehicle->id,
                    'unit_price' => $vehicle->price,
                    'quantity' => $quantity,
                    'total_price' => $vehicle->price * $quantity
                ]);

                $results->add($res !== null);
                \Log::info("Resultado de la línea para el vehículo ID $vehicle_id:", ['resultado' => $res !== null]);
            }
        }

        $status = $sell && $results->every(fn($value) => $value === true);
        \Log::info('Valor de $status:', ['status' => $status]);

        $titles = [
            'success' => 'Saved!',
            'error' => 'Not saved!',
        ];

        $messages = [
            'success' => 'Sell added successfully!',
            'error' => 'Failed! Some sell lines were not saved correctly.',
        ];

        return redirect()->route('sells.list')
            ->with('result', MessageTools::generate($status, $titles, $messages));
    }

    public function edit(Sell $sell, Request $request)
    {
        $data = $request->validate([
            'seller_id' => 'required',
            'client_id' => 'required'
        ]);

        $result = $sell->update($data);

        return redirect()->route('sells.get', $sell)
            ->with('result', MessageTools::generate($result,
                ['success' => 'Updated!', 'error' => 'Not updated!'],
                ['success' => 'Sell updated successfully!', 'error' => 'Failed!']
            ));
    }

    public function delete(Sell $sell)
    {
        $result = $sell->delete();
        return redirect()->route('sells.list')
            ->with('result', MessageTools::generate($result,
                ['success' => 'Deleted!', 'error' => 'Not deleted!'],
                ['success' => 'Sell removed successfully!', 'error' => 'Failed!']
            ));
    }

}
