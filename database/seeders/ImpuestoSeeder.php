<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImpuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('impuestos')->insert([
            'nombre'    => '18%',
            'valor'     => 18,
            'estado'    => 'ACTIVO'
        ]);
        DB::table('impuestos')->insert([
            'nombre'    => '0%',
            'valor'     => 0,
            'estado'    => 'ACTIVO'
        ]);
    }
}
