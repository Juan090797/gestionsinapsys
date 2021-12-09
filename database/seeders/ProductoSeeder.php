<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'codigo' => '0000000001',
            'modelo' => 'Modelo 1',
            'nombre' => 'Nombre del producto 1',
            'descripcion' => 'descripcion del producto 1',
            'precio' => '98000.00',
            'tipo' => 'Tipo 1',
            'marca_id' => '1',
            'familia_id' => '1'
        ]);
        DB::table('productos')->insert([
            'codigo' => '0000000002',
            'modelo' => 'Modelo 2',
            'nombre' => 'Nombre del producto 2',
            'descripcion' => 'descripcion del producto 2',
            'precio' => '25000.00',
            'tipo' => 'Tipo 2',
            'marca_id' => 1,
            'familia_id' => 1
        ]);
        DB::table('productos')->insert([
            'codigo' => '0000000003',
            'modelo' => 'Modelo 3',
            'nombre' => 'Nombre del producto 3',
            'descripcion' => 'descripcion del producto 3',
            'precio' => '55000.00',
            'tipo' => 'Tipo 3',
            'marca_id' => 1,
            'familia_id' => 1
        ]);
    }
}
