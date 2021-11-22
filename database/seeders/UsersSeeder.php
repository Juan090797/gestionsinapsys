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
            'name' => 'Usuario 1',
            'email' => 'sistemas1@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Usuario 2',
            'email' => 'sistemas2@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
        DB::table('users')->insert([
            'name' => 'Usuario 3',
            'email' => 'sistemas3@gruposinapsys.pe',
            'password' => bcrypt('989688456')
        ]);
    }
}
