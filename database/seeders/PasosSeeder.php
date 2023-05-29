<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pasos;

class PasosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $secuencia = "<ul><li>primer paso</li><li>segundo paso</li><li>tercer paso</li></ul>";

        Pasos::create([
            'secuencia' => $secuencia
        ]);
    }
}
