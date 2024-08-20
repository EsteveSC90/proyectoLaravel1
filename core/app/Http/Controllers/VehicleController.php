<?php

namespace App\Http\Controllers;

use App\Helpers\MessageTools;
use App\Helpers\VehicleBuilder;
use App\Models\Car;
use App\Models\Sell;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class VehicleController extends Controller
{

    public function list()
    {

        $columns = Schema::getColumnListing('vehicles');
//        $vehicles = Vehicle::all(); // así obtendriamos todos los vehiculos
        // Obtener los vehículos paginados
        $vehicles = Vehicle::paginate(5); // Cambia 15 por el número de elementos por página que desees
        // return view('vehicles.list', ['vehicles' => $vehicles]);
        return view('vehicles.list', compact('columns', 'vehicles'))->with('types', Vehicle::TYPES);
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:255',
        ]);

        $search = $request->input('search');

        //$v = DB::table('vehicles')->where('registration', $value)->get();
        //$v = Vehicle::query()->where('registration', $value)->get();
        // Más frecuente
        $vehicles = Vehicle::where('registration', $search)
                    ->orWhere('type', 'like', "%$search%")
                    ->orWhere('brand', 'like', "%$search%")
                    ->orWhere('color', 'like', "%$search%")
            ->paginate(5)->withQueryString();

        $columns = Schema::getColumnListing('vehicles');

        // return view('vehicles.list', ['vehicles' => $vehicles]);
        return view('vehicles.list', compact('columns', 'vehicles', 'search'))
            ->with('types', Vehicle::TYPES);
    }

    public function get($id)
    {
        $vehicle = Vehicle::findOrFail($id); // Suponiendo que estás utilizando el modelo Client para acceder a los datos del cliente
        $types = Vehicle::TYPES;
        return view('vehicles.show', compact('vehicle'))->with('types', Vehicle::TYPES);
    }

    public function add(Request $request)
    {
        try{
            $request->validate([
                'type' => 'required|in:Car,Motorbike,Tractor',
                'registration' => 'required|string|max:255|unique:vehicles',
    //            'brand' => 'required|string|max:255',
    //            'color' => 'required|string|max:255',
    //            'price' => 'required|numeric|min:0',
    //            'km' => 'required|numeric|min:0',
            ]);

            // Get wheels and seats from model
            $model = "\App\Models\\" . ucfirst($request->type);
            $wheels = $model::$WHEELS;
            $seats = $model::$SEATS;

            // Guarda el vehículo en la base de datos
            Vehicle::create([
                'registration' => $request->registration,
                'type' => $request->type,
                'brand' => $request->brand,
                'wheels' => $wheels,
                'seats' => $seats,
                'color' => $request->color,
                'price' => $request->price,
                'is_second_hand' => $request->has('is_second_hand') ? true : false,
                'km' => $request->km,
                'is_available' => $request->has('is_available') ? true : false,
                // Otros campos del formulario
            ]);

            $result = true;
        } catch (\Exception $e) {
            $result = false;
        }

        return redirect()->route('vehicles.list')
            ->with('result', MessageTools::generate($result,
                ['success' => 'Vehículo creado exitosamente.', 'error' => 'Error al crear el vehículo.'],
                ['success' => 'Operación exitosa', 'error' => 'Operación fallida']
            ));

    }

    public function edit(Vehicle $vehicle, Request $request)
    {
        //dd($request->input());

        $data = $request->validate([
            'type' => 'required|in:Car,Motorbike,Tractor',
            'registration' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'km' => 'required|numeric|min:0'
        ]);

        // Checkbox validation
        $data['is_second_hand'] = $request->has('is_second_hand') ? 1 : 0;
        $data['is_available'] = $request->has('is_available') ? 1 : 0;

         $result = $vehicle->update($data);

        return redirect()->route('vehicles.list')
            ->with('result', MessageTools::generate($result,
                ['success' => 'Updated!', 'error' => 'Not updated!'],
                ['success' => 'Vehicle updated successfully!', 'error' => 'Failed!']
            ));


    }

    public function delete(Vehicle $vehicle)
    {
        $result = $vehicle->delete();
        return redirect()->route('vehicles.list')
            ->with('result', MessageTools::generate($result,
                ['success' => 'Deleted!', 'error' => 'Not deleted!'],
                ['success' => 'Vehicle deleted successfully!', 'error' => 'Failed!']
            ));

    }

}
