<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(ViviendaSeeder::class);

        $this->call(TasacionSeeder::class);

        User::factory(10)
            ->create();

        // Creación del usuario administrador (temporal para la prueba)
        User::create([
            'nombre' => 'Monica',
            'apellidos' => 'apellido1 apellido 2',    
            'email' => 'demateu80@gmail.com',
            ]) ; 
    }
}
