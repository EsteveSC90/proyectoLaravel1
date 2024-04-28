<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea 10 elementos aleatorios utilizando la fábrica VehicleFactory
        \App\Models\Vehicle::factory(10)->create();
    }
}
