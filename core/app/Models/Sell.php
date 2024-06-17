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

    /**
     * MANZANAS => 3,00
     * PLATANOS => 1,00
     * PERAS => 2,00
     *
     */


    /**
     * TICKET MERCADONA 16/06/2024    ===> CABECERA (SELL)
     * COMPRADOR: ESTEVE
     * CAJERO: PACO
     *
     * MANZANAS 1 3,00 = 3,00 ===> LINEAS (SELL_LINES)
     * PLATANOS 2 1,00 = 2,00 ===> LINEAS (SELL_LINES)
     *
     * TOTAL 5,00€
     *
     */

    /**
     * TICKET MERCADONA 17/06/2024    ===> CABECERA (SELL)
     * COMPRADOR: ALEJANDRO
     * CAJERO: PACO
     *
     * MANZANAS 1 4,00 = 4,00 ===> LINEAS (SELL_LINES)
     * PLATANOS 2 3,00 = 6,00 ===> LINEAS (SELL_LINES)
     *
     * TOTAL 10,00€
     *
     */

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
