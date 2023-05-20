<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorias;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categorias::create([
          "nombre" => "Postre"
        ]);
        Categorias::create([
          "nombre" => "Pasta"
        ]);
        Categorias::create([
          "nombre" => "Carne"
        ]);
        Categorias::create([
          "nombre" => "Pescado"
        ]);
    }
}
