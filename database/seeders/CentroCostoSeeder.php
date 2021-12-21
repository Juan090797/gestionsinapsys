<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CentroCostoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('centro_costos')->insert([
            'nombre' => 'Sistemas',
            'estado' => 'Activo'
        ]);
        DB::table('centro_costos')->insert([
            'nombre' => 'Ventas',
            'estado' => 'Activo'
        ]);
        DB::table('centro_costos')->insert([
            'nombre' => 'Administrativos',
            'estado' => 'Activo'
        ]);
        DB::table('centro_costos')->insert([
            'nombre' => 'Soporte Tecnico',
            'estado' => 'Activo'
        ]);
    }
}
