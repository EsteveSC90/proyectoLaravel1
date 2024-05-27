<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellLines extends Model
{
    use HasFactory;

    protected $fillable = [
        'sell_id',
        'vehicle_id',
        'unit_price',
        'quantity',
        'total_price'
    ];

    public function sell()
    {
        return $this->belongsTo(Sell::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }


}
