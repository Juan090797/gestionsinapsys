<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ClasificacionSeeder::class);
        $this->call(FamiliasSeeder::class);
        $this->call(IndustriaSeeder::class);
        $this->call(MarcasSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(UnidadMedidaSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ImpuestoSeeder::class);
    }
}
