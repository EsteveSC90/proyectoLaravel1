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

    public function edit(SellLines $sell_line, Request $request)
    {



        $sell_line->update();

    }

    public function delete(SellLines $sell_line)
    {
        $sell_line->delete();
        return view('sells.show');
    }

}
