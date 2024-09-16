<?php

namespace Database\Seeders;

use App\Models\Vivienda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViviendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vivienda::factory(20)
        ->create();
    }
}
