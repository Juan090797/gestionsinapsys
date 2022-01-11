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
            'codigo'            => '0000000001',
            'modelo'            => 'Modelo 1',
            'estado'            => 'Activo',
            'nombre'            => 'Nombre del producto 1',
            'descripcion'       => 'descripcion del producto 1',
            'precio_venta'      => '98000.00',
            'tipo'              => 'Baño Maria',
            'marca_id'          => 1,
            'clasificacions_id' => 1,
            'unidad_medidas_id' => 1,
        ]);
        DB::table('productos')->insert([
            'codigo'            => '0000000002',
            'modelo'            => 'Modelo 2',
            'estado'            => 'Activo',
            'nombre'            => 'Nombre del producto 2',
            'descripcion'       => 'descripcion del producto 2',
            'precio_venta'      => '25000.00',
            'tipo'              => 'Microscopio',
            'marca_id'          => 1,
            'clasificacions_id' => 1,
            'unidad_medidas_id' => 1,
        ]);
        DB::table('productos')->insert([
            'codigo'            => '0000000003',
            'modelo'            => 'Modelo 3',
            'estado'            => 'Activo',
            'nombre'            => 'Nombre del producto 3',
            'descripcion'       => 'descripcion del producto 3',
            'precio_venta'      => '55000.00',
            'tipo'              => 'Ventilador',
            'marca_id'          => 1,
            'clasificacions_id' => 1,
            'unidad_medidas_id' => 1,
        ]);
    }
}
