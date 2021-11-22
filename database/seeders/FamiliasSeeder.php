<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamiliasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('familias')->insert([
            'nombre' => 'Microscopio',
            'estado' => 'ACTIVO'
        ]);
        DB::table('familias')->insert([
            'nombre' => 'Baño Maria',
            'estado' => 'ACTIVO'
        ]);
    }
}
