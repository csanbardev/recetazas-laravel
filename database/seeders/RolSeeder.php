<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rol1 = Role::create(['name' => 'Admin']);
        $rol2 = Role::create(['name' => 'Usuario']);

        Permission::create(['name'=>'admin'])->assignRole($rol1);
        Permission::create(['name'=>'user'])->syncRoles([$rol1, $rol2]);


        // para más de un rol syncRoles([...,....,...,...])

    }
}
