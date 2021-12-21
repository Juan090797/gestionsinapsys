<?php

namespace App\Http\Livewire\Compras;

use App\Http\Livewire\Compras\Traits\CalcularCompra;
use App\Http\Livewire\Compras\Traits\DataCompra;
use App\Models\CentroCosto;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Producto;
use App\Models\Proveedor;
use Livewire\Component;

class CreateCompra extends Component
{
    use CalcularCompra;
    use DataCompra;
    public $state = [];

    public function render()
    {
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        $costos = CentroCosto::all();

        return view('livewire.compras.create-compra',
        [
            'productos' => $productos,
            'proveedores' => $proveedores,
            'costos' => $costos,
        ]
        )->extends('layouts.tema.app')->section('content');
    }

    public function createCompra()
    {
        $compra = Compra::create([
            'tipo_documento'            => $this->state['tipo_documento'],
            'numero_documento'     => $this->state['numero_documento'],
            'fecha_documento' => $this->state['fecha_documento'],
            'fecha_pago'        => $this->state['fecha_pago'],
            'subtotal'          => $this->subTotal,
            'impuesto'          => $this->impuestoD,
            'total'             => $this->total,
            'total_items'           => $this->cantidadTotal,
            'proveedor_id'      => $this->state['proveedor_id'],
            'centro_costo_id' => $this->state['centro_costo_id'],
        ]);

        foreach ($this->rows as $item){
            CompraDetalle::create([
                'compra_id'     => $compra->id,
                'producto_id'   => $item['producto_id'],
                'cantidad'      => $item['cantidad'],
                'precio_u'      => $item['precio'],
                'precio_t'      => $item['monto'],
            ]);
        }

        foreach ($this->rows as $item){
            $producto = Producto::find($item['producto_id']);
            $producto->update([
                'precio_compra' => $item['monto'],
            ]);
        }

        $this->emit('compra-registrada', 'Compra Registrado');
        return redirect()->route('compras');
    }

}
