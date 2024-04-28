<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\ClientSellerUtils;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->truncateTables([
            'users', 'sellers', 'clients', 'vehicles'
        ]);

        $this->call(UserSeeder::class);
        $this->call(SellerSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(VehicleSeeder::class);
    }

    protected function truncateTables(array $tables) {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Deshabilitar la revision de claves ajenas antes de hacer el truncate

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Habilitar la revision de claves ajenas antes de hacer el truncate
    }
}
