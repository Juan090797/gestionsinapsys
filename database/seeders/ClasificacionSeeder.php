<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clasificacions')->insert([
            'nombre' => 'Activos',
            'estado' => 'ACTIVO'
        ]);
        DB::table('clasificacions')->insert([
            'nombre' => 'Mercaderias',
            'estado' => 'ACTIVO'
        ]);
        DB::table('clasificacions')->insert([
            'nombre' => 'Servicios',
            'estado' => 'ACTIVO'
        ]);
        DB::table('clasificacions')->insert([
            'nombre' => 'Insumos',
            'estado' => 'ACTIVO'
        ]);
        DB::table('clasificacions')->insert([
            'nombre' => 'Otros',
            'estado' => 'ACTIVO'
        ]);
    }
}
