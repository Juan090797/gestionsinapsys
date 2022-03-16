<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'      => 'Juan Marquina',
            'email'     => 'sistemas@gruposinapsys.pe',
            'dni'       => '70037937',
            'estado'    => 'Activo',
            'area'      => 'Sistemas',
            'perfil'    => 'Administrador',
            'password'  => bcrypt('989688456')
        ]);
        $user->assignRole('Administrador');

        $user = User::create([
            'name' => 'Roberto Guzman',
            'email' => 'r.guzman@gruposinapsys.pe',
            'dni'       => '70037938',
            'estado'    => 'Activo',
            'area'      => 'Gerencia',
            'perfil'    => 'Gerencia',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Gerencia');

        $user = User::create([
            'name' => 'Diana Guzman',
            'email' => 'd.guzman@gruposinapsys.pe',
            'dni'       => '70037939',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'perfil'    => 'Soporte',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Soporte');

        $user = User::create([
            'name' => 'Marco Nolasco',
            'email' => 'm.nolasco@gruposinapsys.pe',
            'dni'       => '70037931',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'perfil'    => 'Soporte',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Soporte');

        $user = User::create([
            'name' => 'Elizabeth Puyen',
            'email' => 'e.puyen@gruposinapsys.pe',
            'dni'       => '70037932',
            'estado'    => 'Activo',
            'area'      => 'Ventas',
            'perfil'    => 'Ventas',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Ventas');

        $user = User::create([
            'name' => 'Caroline Sanchez',
            'email' => 'c.sanchez@gruposinapsys.pe',
            'dni'       => '70037933',
            'estado'    => 'Activo',
            'area'      => 'Administracion',
            'perfil'    => 'Contabilidad',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Contabilidad');

        $user = User::create([
            'name' => 'Evelyn Laura',
            'email' => 'e.laura@gruposinapsys.pe',
            'dni'       => '70037934',
            'estado'    => 'Activo',
            'area'      => 'Ventas',
            'perfil'    => 'Ventas',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Ventas');

        $user = User::create([
            'name' => 'Grimaneza Castro',
            'email' => 'g.castro@gruposinapsys.pe',
            'dni'       => '70037935',
            'estado'    => 'Activo',
            'area'      => 'Post Venta',
            'perfil'    => 'Postventa',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Postventa');

        $user = User::create([
            'name' => 'Rodrigo Alvarado',
            'email' => 'r.alvarado@gruposinapsys.pe',
            'dni'       => '70017936',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'perfil'    => 'Soporte',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Soporte');

        $user = User::create([
            'name' => 'Jeremias Salas',
            'email' => 'j.salas@gruposinapsys.pe',
            'dni'       => '72037936',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'perfil'    => 'Soporte',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Soporte');

        $user = User::create([
            'name' => 'Yorch Pajuelo',
            'email' => 'y.pajuelo@gruposinapsys.pe',
            'dni'       => '70037947',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'perfil'    => 'Soporte',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Soporte');

        $user = User::create([
            'name' => 'Joannelly Reyes',
            'email' => 'j.reyes@gruposinapsys.pe',
            'dni'       => '70037957',
            'estado'    => 'Activo',
            'area'      => 'Recepecion',
            'perfil'    => 'Recepcion',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Recepcion');

        $user = User::create([
            'name' => 'Nerida Lumbreras',
            'email' => 'n.lumbreras@gruposinapsys.pe',
            'dni'       => '70037958',
            'estado'    => 'Activo',
            'area'      => 'Servicios',
            'perfil'    => 'Servicios',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Servicios');

        $user = User::create([
            'name' => 'Crismar Sanchez',
            'email' => 'c.silva@gruposinapsys.pe',
            'dni'       => '70937958',
            'estado'    => 'Activo',
            'area'      => 'Servicios',
            'perfil'    => 'Ventas',
            'password' => bcrypt('989688456')
        ]);
        $user->assignRole('Ventas');
    }
}
