<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    // Agrega los campos fillable
    protected $fillable = [
        'client_id',
        'seller_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function lines()
    {
        return $this->hasMany(SellLines::class);
    }

    public function total() {
        return $this->lines()->sum('total_price');
        /*$total = 0;
        foreach ($this->lines() as $line) {
            $total += $line->total_price;
        }
        return $total;*/
    }
}
