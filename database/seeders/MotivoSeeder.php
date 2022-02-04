<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motivos')->insert([
            'nombre' => 'Ingreso por compras',
            'tipo'   => 'I'
        ]);
        DB::table('motivos')->insert([
            'nombre' => 'Salida por ventas',
            'tipo'   => 'S'
        ]);
        DB::table('motivos')->insert([
            'nombre' => 'Salida por asignacion',
            'tipo'   => 'S'
        ]);
        DB::table('motivos')->insert([
            'nombre' => 'Salida por venta rapida',
            'tipo'   => 'S'
        ]);
        DB::table('motivos')->insert([
            'nombre' => 'Salida por consumo interno',
            'tipo'   => 'S'
        ]);
        DB::table('motivos')->insert([
            'nombre' => 'Ingreso por ajuste de inventario',
            'tipo'   => 'I'
        ]);
        DB::table('motivos')->insert([
            'nombre' => 'Ingreso por produccion',
            'tipo'   => 'I'
        ]);
        DB::table('motivos')->insert([
            'nombre' => 'Salida por vencimiento',
            'tipo'   => 'S'
        ]);
        DB::table('motivos')->insert([
            'nombre' => 'Salida por deterioro',
            'tipo'   => 'S'
        ]);
    }
}
