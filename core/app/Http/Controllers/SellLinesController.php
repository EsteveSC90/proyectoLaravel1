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

class SellLinesController extends Controller
{

    public function get(Sell $sell, SellLines $line)
    {
        $vehicles = Vehicle::all();
        return view('sells_lines.show', compact('sell', 'line', 'vehicles'));
    }

    public function add(Sell $sell, Request $request)
    {
        $data = $request->validate([
            'vehicle_id' => 'required',
            'quantity' => 'required',
        ]);

        $vehicle = Vehicle::where($data['vehicle_id']);

        $data['unit_price'] = $vehicle->price;
        $data['total_price'] = $vehicle->price * $data['quantity'];

        $sell->lines()->create($data);
    }

    public function edit(Sell $sell, SellLines $line, Request $request)
    {
        $data = $request->validate([
            'vehicle_id' => 'required',
            'quantity' => 'required|string|max:255'
        ]);

        $data['unit_price'] = Vehicle::find($data['vehicle_id'])->price;
        $data['total_price'] = $data['unit_price'] * $data['quantity'];
        $result = $line->update($data);

        return redirect()->route('sells.get', $sell)
            ->with('result', MessageTools::generate($result,
                ['success' => 'Updated!', 'error' => 'Not updated!'],
                ['success' => 'Sell line updated successfully!', 'error' => 'Failed!']
            ));
    }

    public function delete(Sell $sell, SellLines $line)
    {
        $result = $line->delete();
        return redirect()->route('sells.get', $sell)
            ->with('result', MessageTools::generate($result,
                ['success' => 'Deleted!', 'error' => 'Not deleted!'],
                ['success' => 'Sell line deleted successfully!', 'error' => 'Failed!']
            ));
    }

}
