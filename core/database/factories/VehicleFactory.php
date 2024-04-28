<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $carBrands = ['Toyota', 'Honda', 'Ford', 'Chevrolet', 'BMW', 'Audi', 'Mercedes-Benz', 'Volkswagen', 'Nissan', 'Hyundai', 'Kia', 'Volvo', 'Mazda', 'Subaru', 'Lexus', 'Porsche', 'Ferrari', 'Tesla', 'Jaguar', 'Land Rover', 'Jeep', 'Mitsubishi', 'Acura', 'Infiniti', 'Buick', 'Cadillac', 'Chrysler', 'Dodge', 'GMC', 'Lincoln', 'RAM', 'Mini', 'Alfa Romeo', 'Fiat', 'Smart', 'Maserati', 'Bentley', 'Bugatti', 'Lamborghini', 'McLaren', 'Rolls-Royce'];
        $type = fake()->randomElement(['Car', 'Motorbike', 'Tractor']);

        switch ($type) {
            case 'Car':
            default:
                $wheels = 4;
                $seats = 5;
                break;
            case 'Motorbike':
                $wheels = 2;
                $seats = 1;
                break;
            case 'Tractor':
                $wheels = 6;
                $seats = 2;
                break;
        }

        // Generar un precio falso entre 10.000 y 50.000
        $price = fake()->randomFloat(2, 10000, 50000);

        return [
            'registration' => fake()->randomNumber(3) . fake()->randomLetter . fake()->randomLetter . fake()->randomLetter,
            'type' => $type,
            'brand' => fake()->randomElement($carBrands),
            'wheels' => $wheels,
            'seats' => $seats,
            'color' => fake()->colorName(), // Corregido: Utiliza $faker en lugar de fake()
            'price' => $price, // Corregido: Ya tienes el valor generado, no necesitas usar fake() de nuevo
            'is_second_hand' => fake()->boolean,
            'km' => fake()->randomNumber(4),
            'is_available' => fake()->boolean,
        ];
    }
}
