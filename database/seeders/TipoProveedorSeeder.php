<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Agente de Aduanas',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Agente de Carga Internacional',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Almacen',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Banco',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Broker',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Cliente',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Comerciante',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Compañia Area',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Distribuidor',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Extranjero',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Fabricante',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Operador Logistico Internacional',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Otros',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Representante',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Transporte',
            'estado' => 'ACTIVO',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Tributario',
            'estado' => 'ACTIVO',
        ]);
    }
}
