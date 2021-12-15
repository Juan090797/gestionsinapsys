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
            'nombre' => 'Unidad',
            'estado' => 'Activo'
        ]);
        DB::table('unidad_medidas')->insert([
            'nombre' => 'Kilogramo',
            'estado' => 'Activo'
       ]);
       DB::table('unidad_medidas')->insert([
             'nombre' => 'Pieza',
             'estado' => 'Activo'
       ]);
       DB::table('unidad_medidas')->insert([
            'nombre' => 'Millar',
            'estado' => 'Activo'
       ]);
       DB::table('unidad_medidas')->insert([
             'nombre' => 'Docena',
             'estado' => 'Activo'
       ]);
    }
}
