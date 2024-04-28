<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seller;
use Illuminate\Support\Carbon;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea 2 elementos aleatorios utilizando la fábrica SellerFactory
       // \App\Models\Seller::factory(2)->create();

        Seller::factory()->create([
           'dni' => '654782245A',
           'name' => 'Maria Isabel',
           'surname' => 'Cabra Olivares',
           'telephone_num' => '655448811',
           'address' => 'calle sol n122 bajos',
           'email_address' => 'maribelco@gmail.com',
        ]);
    }
}
