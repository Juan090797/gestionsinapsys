<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'nombre'            => 'APPLE',
            'correo'            => 'APPLE@APPLE.COM',
            'direccion'         => 'Calle Belgica Mz. H Lt.8',
            'estado'            => 'ACTIVO',
            'pagina_web'        => 'www.google.com',
            'telefono'          => '(01) 554-9104',
            'descripcion'       => 'CORPORACION SINAPSYS S.A.C',
            'ruc'               => '20606088630',
            'razon_social'      => 'Apple Inc.',
            'detalle_banco'     => '(01) 554-9071, (01) 554-9104',
            'ciudad_entrega'    => 'Peru',
            'ciudad_recojo'     => 'Peru',
            'direccion_entrega' => 'Peru',
            'direccion_recojo'  => 'Peru',
            'pais_entrega'      => 'Peru',
            'pais_recojo'       => 'Peru',
            'usuario_auditoria' => 'Juan Marquina',
            'tipo_documento_id' => 1,
            'industria_id'      => 1,
            'categoria_id'      => 1
        ]);

        DB::table('clientes')->insert([
            'nombre'            => 'SANSUNG',
            'correo'            => 'sansung@sansung.com',
            'direccion'         => 'Calle Portugal Mz. H Lt.8',
            'estado'            => 'ACTIVO',
            'pagina_web'        => 'www.sansung.com',
            'telefono'          => '(01) 554-9104',
            'descripcion'       => 'Sansung',
            'ruc'               => '20606088440',
            'razon_social'      => 'Sansung Inc.',
            'detalle_banco'     => '(01) 554-9071, (01) 554-9104',
            'ciudad_entrega'    => 'Peru',
            'ciudad_recojo'     => 'Peru',
            'direccion_entrega' => 'Peru',
            'direccion_recojo'  => 'Peru',
            'pais_entrega'      => 'Peru',
            'pais_recojo'       => 'Peru',
            'usuario_auditoria' => 'Juan Marquina',
            'tipo_documento_id' => 1,
            'industria_id'      => 1,
            'categoria_id'      => 1
        ]);
    }
}
