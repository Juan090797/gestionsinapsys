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
            'nombre' => 'Ingresos por compras',
        ]);
        DB::table('motivos')->insert([
            'nombre' => 'Salidas por ventas',
        ]);
        DB::table('motivos')->insert([
            'nombre' => 'Ingresos por compras',
        ]);
        DB::table('motivos')->insert([
            'nombre' => 'Salidas por ventas',
        ]);
    }
}
