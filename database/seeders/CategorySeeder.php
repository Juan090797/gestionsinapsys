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
            'nombre' => 'CLIENTE',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'COMPETENCIA',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'ANALISTA',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'CONSULTOR',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'INVERSIONISTA',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'SOCIO',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'LOGISTICO',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'PROYECTISTA',
            'estado' => 'ACTIVO'
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'OTRO',
            'estado' => 'ACTIVO'
        ]);
    }
}
