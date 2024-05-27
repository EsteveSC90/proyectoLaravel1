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

}
