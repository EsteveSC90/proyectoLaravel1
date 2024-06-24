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
    // Relación uno a uno con Address
    public function address()
    {
        return $this->hasOne(Address::class);
    }


}
