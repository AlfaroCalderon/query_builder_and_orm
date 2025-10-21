<?php

namespace Database\Factories;
use App\Models\Usuarios;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuarios>
 */
class UsuariosFactory extends Factory
{

    protected $model = Usuarios::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->numberBetween(70000000, 79999999)
        ];
    }
}
