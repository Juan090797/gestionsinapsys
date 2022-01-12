<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtapaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('etapas')->insert([
            'nombre'    => 'Inicio',
        ]);
        DB::table('etapas')->insert([
            'nombre'    => 'Planeamiento',
        ]);
        DB::table('etapas')->insert([
            'nombre'    => 'Ejecucion',
        ]);
        DB::table('etapas')->insert([
            'nombre'    => 'Monitoreo y Control',
        ]);
        DB::table('etapas')->insert([
            'nombre'    => 'Cierre',
        ]);
    }
}
