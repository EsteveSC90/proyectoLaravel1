<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea 10 elementos aleatorios utilizando la fábrica ClientFactory
        \App\Models\Client::factory(10)->create();
    }
}
