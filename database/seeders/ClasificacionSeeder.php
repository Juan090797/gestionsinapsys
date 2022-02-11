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
            'nombre' => 'ACTIVOS',
            'estado' => 'ACTIVO'
        ]);
        DB::table('clasificacions')->insert([
            'nombre' => 'MERCADERIAS',
            'estado' => 'ACTIVO'
        ]);
        DB::table('clasificacions')->insert([
            'nombre' => 'SERVICIOS',
            'estado' => 'ACTIVO'
        ]);
        DB::table('clasificacions')->insert([
            'nombre' => 'INSUMOS',
            'estado' => 'ACTIVO'
        ]);
        DB::table('clasificacions')->insert([
            'nombre' => 'OTROS',
            'estado' => 'ACTIVO'
        ]);
    }
}
