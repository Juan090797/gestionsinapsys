<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::create([
            'nombre' => 'DNI',
            'codigo' => 1,
            'tipo'   => 'identidad'
        ]);
        TipoDocumento::create([
            'nombre' => 'CARNET DE EXTRANJERIA',
            'codigo' => 4,
            'tipo'   => 'identidad'
        ]);
        TipoDocumento::create([
            'nombre' => 'RUC',
            'codigo' => 6,
            'tipo'   => 'identidad'
        ]);
        TipoDocumento::create([
            'nombre' => 'PASAPORTE',
            'codigo' => 7,
            'tipo'   => 'identidad'
        ]);
        TipoDocumento::create([
            'nombre' => 'CEDULA DIPLOMATICA DE IDENTIDAD',
            'codigo' => 'A',
            'tipo'   => 'identidad'
        ]);
        ///////////////////////////////////////////////////////////////
        TipoDocumento::create([
            'nombre' => 'FACTURA',
            'codigo' => '01',
            'tipo'   => 'pago'
        ]);
        TipoDocumento::create([
            'nombre' => 'RECIBO POR HONORARIOS',
            'codigo' => '02',
            'tipo'   => 'pago'
        ]);
        TipoDocumento::create([
            'nombre' => 'BOLETA DE VENTA',
            'codigo' => '03',
            'tipo'   => 'pago'
        ]);
        TipoDocumento::create([
            'nombre' => 'RECIBO DE SERVICIOS',
            'codigo' => 14,
            'tipo'   => 'pago'
        ]);
        TipoDocumento::create([
            'nombre' => 'OTROS',
            'codigo' => '0',
            'tipo'   => 'pago'
        ]);
        TipoDocumento::create([
            'nombre' => 'NOTA DE CREDITO',
            'codigo' => 7,
            'tipo'   => 'pago'
        ]);
        TipoDocumento::create([
            'nombre' => 'NOTA DE DEBITO',
            'codigo' => 8,
            'tipo'   => 'pago'
        ]);
    }
}
