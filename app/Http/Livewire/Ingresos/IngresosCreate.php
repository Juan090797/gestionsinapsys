<?php

namespace App\Http\Livewire\Ingresos;

use App\Http\Livewire\ComponenteBase;
use App\Http\Livewire\Ingresos\Traits\CalcularIngreso;
use App\Http\Livewire\Ingresos\Traits\DataIngreso;
use App\Models\Producto;
use App\Models\Proveedor;

class IngresosCreate extends ComponenteBase
{
    use DataIngreso;
    use CalcularIngreso;

    public function render()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('livewire.ingresos.ingresos-create',[
            'proveedores' => $proveedores,
            'productos'   => $productos,
        ])->extends('layouts.tema.app')->section('content');
    }
}
