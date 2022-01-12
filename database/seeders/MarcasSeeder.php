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
            'nombre' => 'Yamato',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Bell',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'MPW',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'LMB',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Polyscience',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Fiochetti',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Pobel',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Convergent',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Astell',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Giorgio Bormac',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Heathrow',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Mobercas',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Biobase',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Angelantoni',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Shinva',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Lifotronic',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Argolab',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Biosan',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Dialab',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Wasserlab',
            'estado' => 'ACTIVO'
        ]);
        DB::table('marcas')->insert([
            'nombre' => 'Xs instruments',
            'estado' => 'ACTIVO'
        ]);
    }
}
