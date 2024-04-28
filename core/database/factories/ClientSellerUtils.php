<?php

namespace Database\Factories;

class ClientSellerUtils
{
    public static function getFakeData() {
        return [
            'dni' => fake()->unique()->numerify('########'), // Genera un DNI aleatorio de 8 dígitos
            'name' => fake()->firstName,
            'surname' => fake()->lastName,
            'telephone_num' => self::generatePhoneNumber(), // Genera un número entero de 6 dígitos que empiece por 678 o 9
            'address' => fake()->address,
            'email_address' => fake()->unique()->safeEmail,
        ];
    }

    public static function generatePhoneNumber()
    {
        $prefix = fake()->numberBetween(6, 9);
        $suffix = fake()->numberBetween(0, 99999999); // Número aleatorio de 0 a 99999999

        // Ajustar la longitud del sufijo para que siempre tenga 6 dígitos
        $suffix = str_pad($suffix, 8, '0', STR_PAD_LEFT);

        return (int)($prefix . $suffix);
    }
}
