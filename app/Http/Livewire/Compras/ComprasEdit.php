<?php

namespace App\Http\Livewire\Compras;

use App\Http\Livewire\Compras\Traits\CalcularCompra;
use App\Http\Livewire\Compras\Traits\DataCompra;
use App\Models\CentroCosto;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use Livewire\Component;

class ComprasEdit extends Component
{
    use CalcularCompra;
    use DataCompra;

    public $state = [];
    public $movimiento, $lista;

    public function mount(Compra $compra)
    {
        $this->state = $compra->toArray();
        $this->rows = $compra->compraDetalles->toArray();
        $this->cantidadTotal = $compra->total_items;
        $this->subTotal = $compra->subtotal;
        $this->impuestoD = $compra->impuesto;
        $this->total = $compra->total;
    }
    public function render()
    {
        $proveedores = Proveedor::all();
        $costos = CentroCosto::all();
        $productos = Producto::all();
        return view('livewire.compras.compras-edit',['proveedores'=> $proveedores, 'costos' => $costos, 'productos' => $productos])->extends('layouts.tema.app')->section('content');
    }
}
