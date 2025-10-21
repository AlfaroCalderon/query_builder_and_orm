<?php

namespace Database\Seeders;

use App\Models\Pedidos;
use App\Models\Usuarios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all existing usuarios IDs
        $usuariosIds = Usuarios::pluck('id')->toArray();

        // Check if we have usuarios to reference
        if (empty($usuariosIds)) {
            $this->command->warn('No usuarios found. Please run UsuariosSeeder first.');
            return;
        }

        // Create 50 pedidos, randomly assigning them to existing usuarios
        for ($i = 0; $i < 50; $i++) {
            Pedidos::factory()->create([
                'id_usuario' => fake()->randomElement($usuariosIds)
            ]);
        }

        $this->command->info('Created 50 pedidos for existing usuarios.');
    }
}
