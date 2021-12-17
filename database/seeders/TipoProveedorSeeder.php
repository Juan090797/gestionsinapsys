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
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Agente de Carga Internacional',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Almacen',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Banco',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Broker',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Cliente',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Comerciante',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Compañia Area',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Distribuidor',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Extranjero',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Fabricante',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Operador Logistico Internacional',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Otros',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Representante',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Transporte',
            'estado' => 'Activo',
        ]);
        DB::table('tipo_proveedors')->insert([
            'nombre' => 'Tributario',
            'estado' => 'Activo',
        ]);
    }
}
