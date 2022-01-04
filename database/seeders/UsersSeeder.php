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
            'estado'    => 'Activo',
            'area'      => 'Sistemas',
            'password'  => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Roberto Guzman',
            'email' => 'r.guzman@gruposinapsys.pe',
            'estado'    => 'Activo',
            'area'      => 'Gerencia',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Diana Guzman',
            'email' => 'd.guzman@gruposinapsys.pe',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Marco Nolasco',
            'email' => 'm.nolasco@gruposinapsys.pe',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Elizabeth Puyen',
            'email' => 'e.puyen@gruposinapsys.pe',
            'estado'    => 'Activo',
            'area'      => 'Ventas',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Caroline Sanchez',
            'email' => 'c.sanchez@gruposinapsys.pe',
            'estado'    => 'Activo',
            'area'      => 'Administracion',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Evelyn Laura',
            'email' => 'e.laura@gruposinapsys.pe',
            'estado'    => 'Activo',
            'area'      => 'Ventas',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Grimaneza Castro',
            'email' => 'g.castro@gruposinapsys.pe',
            'estado'    => 'Activo',
            'area'      => 'Post Venta',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Luis Samaniego',
            'email' => 'l.samaniego@gruposinapsys.pe',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Yorch Pajuelo',
            'email' => 'y.pajuelo@gruposinapsys.pe',
            'estado'    => 'Activo',
            'area'      => 'Soporte Tecnico',
            'password' => bcrypt('989688456')
        ]);
    }
}
