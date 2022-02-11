<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => 'Juan Marquina',
            'email'     => 'sistemas@gruposinapsys.pe',
            'dni'       => '70037937',
            'estado'    => 'Activo',
            'area'      => 'Sistemas',
            'password'  => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Roberto Guzman',
            'email' => 'r.guzman@gruposinapsys.pe',
            'dni'       => '70037938',
            'estado'    => 'Activo',
            'area'      => 'Gerencia',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Diana Guzman',
            'email' => 'd.guzman@gruposinapsys.pe',
            'dni'       => '70037939',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Marco Nolasco',
            'email' => 'm.nolasco@gruposinapsys.pe',
            'dni'       => '70037931',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Elizabeth Puyen',
            'email' => 'e.puyen@gruposinapsys.pe',
            'dni'       => '70037932',
            'estado'    => 'Activo',
            'area'      => 'Ventas',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Caroline Sanchez',
            'email' => 'c.sanchez@gruposinapsys.pe',
            'dni'       => '70037933',
            'estado'    => 'Activo',
            'area'      => 'Administracion',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Evelyn Laura',
            'email' => 'e.laura@gruposinapsys.pe',
            'dni'       => '70037934',
            'estado'    => 'Activo',
            'area'      => 'Ventas',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Grimaneza Castro',
            'email' => 'g.castro@gruposinapsys.pe',
            'dni'       => '70037935',
            'estado'    => 'Activo',
            'area'      => 'Post Venta',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Luis Samaniego',
            'email' => 'l.samaniego@gruposinapsys.pe',
            'dni'       => '70037936',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Yorch Pajuelo',
            'email' => 'y.pajuelo@gruposinapsys.pe',
            'dni'       => '70037947',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Joannelly Reyes',
            'email' => 'j.reyes@gruposinapsys.pe',
            'dni'       => '70037957',
            'estado'    => 'Activo',
            'area'      => 'Recepecion',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Nerida Lumbreras',
            'email' => 'n.lumbreras@gruposinapsys.pe',
            'dni'       => '70037958',
            'estado'    => 'Activo',
            'area'      => 'Servicios',
            'password' => bcrypt('989688456')
        ]);
    }
}
