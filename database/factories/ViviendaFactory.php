<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vivienda>
 */
class ViviendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'direccion' => $this->faker->address,
            'precio' => $this->faker->randomFloat($maxDecimals = 2, $min = 0, $max = 2)
        ];
    }
}
