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
            'nombre' => 'SISTEMAS',
            'estado' => 'ACTIVO'
        ]);
        DB::table('centro_costos')->insert([
            'nombre' => 'VENTAS',
            'estado' => 'ACTIVO'
        ]);
        DB::table('centro_costos')->insert([
            'nombre' => 'ADMINISTRATIVOS',
            'estado' => 'ACTIVO'
        ]);
        DB::table('centro_costos')->insert([
            'nombre' => 'SOPORTE TECNICO',
            'estado' => 'ACTIVO'
        ]);
        DB::table('centro_costos')->insert([
            'nombre' => 'GENERAL',
            'estado' => 'ACTIVO'
        ]);
        DB::table('centro_costos')->insert([
            'nombre' => 'POSTVENTA',
            'estado' => 'ACTIVO'
        ]);
        DB::table('centro_costos')->insert([
            'nombre' => 'SERVICIOS',
            'estado' => 'ACTIVO'
        ]);
    }
}
