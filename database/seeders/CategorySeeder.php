<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'nombre' => 'Cliente',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Competencia',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Analista',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Consultor',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Inversionista',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Socio',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Logistico',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Proyectista',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Otro',
            'estado' => 'ACTIVO'
        ]);
    }
}
