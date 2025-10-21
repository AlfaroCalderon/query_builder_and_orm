<?php

namespace Database\Factories;

use App\Models\Pedidos;
use App\Models\Usuarios;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedidos>
 */
class PedidosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'producto' => $this->faker->words(3, true), // Random product name
            'cantidad' => $this->faker->numberBetween(1, 10),
            'total' => $this->faker->randomFloat(2, 10, 1000), // Between $10 and $1000
            'id_usuario' => Usuarios::factory(), // This will create a new usuario if none exists
        ];
    }
}
