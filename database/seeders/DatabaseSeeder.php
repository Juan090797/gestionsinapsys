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
        $this->call(TipoDocumentoSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ClasificacionSeeder::class);
        $this->call(IndustriaSeeder::class);
        $this->call(MarcasSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(UnidadMedidaSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ImpuestoSeeder::class);
        $this->call(TipoProveedorSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(CentroCostoSeeder::class);
        $this->call(MotivoSeeder::class);
        $this->call(EtapaSeeder::class);
    }
}
