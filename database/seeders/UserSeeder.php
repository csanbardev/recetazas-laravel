<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usuarios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
          'name' => 'User',
          'email' => 'user@user.com',
          'password' => bcrypt('42')
        ])->assignRole('Admin');

        User::factory(10)->create();
    }
}
