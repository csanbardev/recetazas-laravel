<?php

namespace Database\Seeders;

use App\Models\Entradas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntradasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Entradas::factory(30)->create();
    }
}
