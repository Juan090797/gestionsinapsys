<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndustriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('industrias')->insert([
            'nombre' => 'Agro-industria',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Textil',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Banco y seguros',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Biotecnologia',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Quimica',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Comunicaciones',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Construccion',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Consultoria',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Educacion',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Electronica',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Energia y mineria',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Ingenieria',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Entretenimiento',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Medio Ambiente',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Financiera',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Alimentaria',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Salud y belleza',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Hospitalaria',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Maquinaria',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Manufactura',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Otras',
            'estado' => 'ACTIVO'
        ]);
        DB::table('industrias')->insert([
            'nombre' => 'Recreacion',
            'estado' => 'ACTIVO'
        ]);
    }
}
