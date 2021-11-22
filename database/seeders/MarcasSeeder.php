<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marcas')->insert([
            'nombre' => 'Euromex',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Lmb',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Mpw',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Wasserlab',
            'estado' => 'ACTIVO'
        ]);
    }
}
