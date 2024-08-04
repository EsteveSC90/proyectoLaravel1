<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration',
        'type',
        'brand',
        'wheels',
        'seats',
        'color',
        'price',
        'is_second_hand',
        'km',
        'is_available',
        // Agrega aquí otros atributos que desees permitir en asignación masiva
    ];

    const TYPES = [
        'Car' => 'Coche',
        'Motorbike' => 'Motocicleta',
        'Tractor' => 'Tractor'
    ];

    public function sell_lines() {
        return $this->hasMany(SellLines::class);
    }

}
