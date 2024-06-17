<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'name',
        'surname',
        'telephone_num',
        'address',
        'email_address'
    ];

    public function sells() {
        return $this->hasMany(Sell::class);
    }

    // TODO
    // Eliminar columna "address" de la tabla de clients
    // Hacer tabla address (migration), relación de 1 a 1 con client VS address

    public function phones() {
        return $this->hasOne(Phone::class);
    }


    /**
     * Address
     *
     * client_id PK
     * address_name
     * city
     * postal_code
     * country
     * $client->address->city
     */



}
