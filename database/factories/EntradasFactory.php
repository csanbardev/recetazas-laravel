<?php

namespace Database\Factories;

use App\Models\Categorias;
use App\Models\Pasos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entradas>
 */
class EntradasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $titulo = $this->faker->unique()->text(20);

        return [
            'titulo' => $titulo,
            'descripcion' => $this->faker->text(100),
            'imagen' => $this->faker->numberBetween($min = 1, $max = 5) .'.jpg',
            'usuario_id' => User::all()->random()->id,
            'categoria_id' => Categorias::all()->random()->id,
            'pasos_id' => Pasos::all()->random()->id,
            'fecha' => $this->faker->date($format = 'Y-m-d', $max = 'now')
        ];
    }
}
