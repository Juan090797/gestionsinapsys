<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([
            'nombre' => 'CORPORACION SINAPSYS S.A.C',
            'ruc' => '20606088630',
            'direccion' => 'Calle Belgica Mz. H Lt.8',
            'telefono' => '(01) 554-9071, (01) 554-9104',
            'celular' => '994786638',
            'correo' => 'ventas@gruposinapsys.pe'
        ]);
    }
}
