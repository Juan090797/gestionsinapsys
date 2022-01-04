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
            'name' => 'Juan Marquina',
            'email' => 'sistemas@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Roberto Guzman',
            'email' => 'r.guzman@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Diana Guzman',
            'email' => 'd.guzman@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Marco Nolasco',
            'email' => 'm.nolasco@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Elizabeth Puyen',
            'email' => 'e.puyen@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Caroline Sanchez',
            'email' => 'c.sanchez@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Evelyn Laura',
            'email' => 'e.laura@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Grimaneza Castro',
            'email' => 'g.castro@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Luis Samaniego',
            'email' => 'l.samaniego@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Yorch Pajuelo',
            'email' => 'y.pajuelo@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
    }
}
