<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tasacion>
 */
class TasacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estado' => $this->faker->randomElement(['Solicitado', 'En proceso', 'Completado', 'Rechazado']),
            'comentarios' => $this->faker->text,
            'gestor_id' => 1,//el admin, para test
            'cliente_id' => $this->faker->numberBetween($min = 2, $max = 25),
            'vivienda_id' => $this->faker->numberBetween($min = 1, $max = 20),
        ];
    }
}
