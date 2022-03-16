<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Gerencia']);
        Role::create(['name' => 'Soporte']);
        Role::create(['name' => 'Ventas']);
        Role::create(['name' => 'Servicios']);
        Role::create(['name' => 'Postventa']);
        Role::create(['name' => 'Contabilidad']);
        Role::create(['name' => 'Recepcion']);
    }
}
