<?php

namespace Database\Seeders;

use App\Models\User;
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
          'nick' => 'user',
          'name' => 'User',
          'apellidos' => 'User',
          'email' => 'user@user.com',
          'password' => bcrypt('42'),
          'avatar' => 'avatar.png'
        ])->assignRole('Admin');

        User::factory(10)->create();
    }
}
