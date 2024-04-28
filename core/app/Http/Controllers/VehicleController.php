<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Sell;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class VehicleController extends Controller
{

    public function list()
    {

        $columns = Schema::getColumnListing('vehicles');
        $vehicles = Vehicle::all();
        // return view('vehicles.list', ['vehicles' => $vehicles]);
        return view('vehicles.list', compact('columns', 'vehicles'));
    }

    public function get($id)
    {
        $vehicle = Vehicle::findOrFail($id); // Suponiendo que estás utilizando el modelo Client para acceder a los datos del cliente
        return view('vehicles.show', compact('vehicle'));
    }

//    public function add(Request $request)
//    {
//        $vehicle = new Vehicle();
//        $vehicle->registration = $request->input('registration');
//        $vehicle->type = $request->input('type');
//        $vehicle->brand = $request->input('brand');
//        $vehicle->wheels = $request->input('wheels');
//        $vehicle->seats = $request->input('seats');
//        $vehicle->color = $request->input('color');
//        $vehicle->price = $request->input('price');
//        $vehicle->is_second_hand = $request->has('is_second_hand');
//        $vehicle->km = $request->input('km');
//        $vehicle->is_available = $request->has('is_available');
//
//        $vehicle->save();
//
//        return redirect()->route('vehicles.list');
//    }

    public function add(Request $request)
    {
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

        // Redireccionar o realizar otras acciones según sea necesario
        return redirect()->route('vehicles.list')->with('success', 'Vehículo creado correctamente');

    }

    public function edit(Vehicle $vehicle, Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:Car,Motorbike,Tractor',
            'registration' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
//            'color' => 'required|string|max:255',
//            'price' => 'required|numeric|min:0',
//            'km' => 'required|numeric|min:0',
        ]);

        $vehicle->update($data);

        // Redireccionar o realizar otras acciones según sea necesario
        return redirect()->route('vehicles.list')->with('success', 'Vehículo actualizado correctamente');
    }

    public function delete(Vehicle $vehicle)
    {
        $result = $vehicle->delete();
        // Redireccionar o realizar otras acciones según sea necesario
        return redirect()->route('vehicles.list')->with('success', 'Vehículo eliminado correctamente');
    }

}
