<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadMedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidad_medidas')->insert([
            'nombre' => 'UNIDAD',
            'estado' => 'Activo',
        ]);
        DB::table('unidad_medidas')->insert([
            'nombre' => 'KILOGRAMO',
            'estado' => 'Activo',
       ]);
       DB::table('unidad_medidas')->insert([
             'nombre' => 'PIEZA',
             'estado' => 'Activo',
       ]);
       DB::table('unidad_medidas')->insert([
             'nombre' => 'LITROS',
             'estado' => 'Activo',
       ]);
        DB::table('unidad_medidas')->insert([
            'nombre' => 'RESMA',
            'estado' => 'Activo',
        ]);
        DB::table('unidad_medidas')->insert([
            'nombre' => 'CAJA',
            'estado' => 'Activo',
        ]);
    }
}
