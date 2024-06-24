<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $primaryKey = 'client_id';
    public $incrementing = false;
    protected $keyType = 'unsignedBigInteger';

    protected  $fillable = [
        'client_id',
        'address_name',
        'city',
        'postal_code',
        'country',
    ];

    /**
     * Obtener el cliente de la dirección
     * */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
