<?php

namespace App\Http\Livewire\Ingresos;

use App\Http\Livewire\ComponenteBase;
use App\Http\Livewire\Ingresos\Traits\CalcularIngreso;
use App\Http\Livewire\Ingresos\Traits\DataIngreso;
use App\Models\Motivo;
use App\Models\Producto;
use App\Models\Proveedor;

class IngresosCreate extends ComponenteBase
{
    use DataIngreso;
    use CalcularIngreso;
    public $proveedores, $productos, $motivos;

    public function render()
    {
        $this->update();
        return view('livewire.ingresos.ingresos-create')->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->proveedores();
        $this->productos();
        $this->motivos();
    }

    public function proveedores()
    {
        $this->proveedores = Proveedor::all();
    }
    public function productos()
    {
        $this->productos = Producto::all();
    }
    public function motivos()
    {
        $this->motivos = Motivo::all();
    }
}
