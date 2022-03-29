<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedors')->insert([
            'ruc'               => '20122145785',
            'razon_social'      => 'Proveedor General SAC.',
            'nombre_comercial'  => 'Proveedor General',
            'direccion'         => 'Av. general 586',
            'telefono'          => '575-0387',
            'celular'           => '987456159',
            'correo'            => 'cliente@general.com',
            'pagina_web'        => 'www.clientegeneral.com',
            'estado'            => 'ACTIVO',
            'tipo_proveedors_id'=> 1,
            'tipo_documento_id' => 3
        ]);
    }
}
