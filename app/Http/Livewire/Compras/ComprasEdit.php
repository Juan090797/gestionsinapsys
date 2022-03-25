<?php

namespace App\Http\Livewire\Compras;

use App\Http\Livewire\Compras\Traits\CalcularCompra;
use App\Http\Livewire\Compras\Traits\DataCompra;
use App\Models\CentroCosto;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ComprasEdit extends Component
{
    use CalcularCompra;
    use DataCompra;
    use LivewireAlert;

    public $state = [];
    public $movimiento, $old;

    public function mount(Compra $compra)
    {
        $this->old = $compra;
        $this->state = $compra->toArray();
        $this->lista = $compra->compraDetalles->toArray();
        $this->cantidadTotal = $compra->total_items;
        $this->otros_gastos = $compra->otros_gastos;
        $this->icbper = $compra->icbper;
        $this->subTotal = $compra->subtotal;
        $this->impuestoD = $compra->impuesto;
        $this->total = $compra->total;
    }
    public function render()
    {
        $proveedores = Proveedor::all();
        $costos = CentroCosto::all();
        $productos = Producto::all();
        return view('livewire.compras.compras-edit',
            ['proveedores'=> $proveedores, 'costos' => $costos, 'productos' => $productos])
            ->extends('layouts.tema.app')->section('content');
    }

    public function actualizarCompra()
    {
        $validated = Validator::make($this->state, [
            'tipo_documento'    => 'required',
            'serie_documento'  => 'required',
            'numero_documento'  => 'required',
            'fecha_documento'   => 'required',
            'fecha_pago'        => 'required',
            'proveedor_id'      => 'required',
            'centro_costo_id'   => 'required',
            'moneda'            => 'required',
            'tipo_cambio'       => '',
            'otros_gastos'      => '',
            'icbper'            => '',
        ],[
            'tipo_documento.required'   => 'El tipo de documento es requerido',
            'serie_documento.required'  => 'La serie del documento es requerido',
            'numero_documento.required' => 'El numero del documento es requerido',
            'fecha_documento.required'  => 'La fecha del documento es requerido',
            'fecha_pago.required'       => 'La fecha de pago es requerido',
            'proveedor_id.required'     => 'El proveedor es requerido',
            'centro_costo_id.required'  => 'El centro de costo es requerido',
            'moneda.required'           => 'La moneda es requerida',
            'tipo_cambio.required'      => '',
            'otros_gastos.required'     => '',
            'icbper.required'           => '',
        ])->validate();

        $validated['estado'] = 'PENDIENTE';
        $validated['otros_gastos'] = $this->otros_gastos;
        $validated['icbper'] = $this->icbper;
        $validated['subtotal'] = $this->subTotal;
        $validated['impuesto'] = $this->impuestoD;
        $validated['total'] = $this->total;
        $validated['total_items'] = $this->cantidadTotal;

        $old = $this->old;
        $input = $this->lista;

        DB::transaction(function() use($old,$input,$validated) {
            $old->update($validated);
            CompraDetalle::where('compra_id', $old->id)->delete();
            collect($input)->filter(function ($item) {
                return $item['producto_id'] !== '';
            })->each(function($item) use($old) {
                CompraDetalle::create([
                        'compra_id'     => $old->id,
                        'producto_id'   => $item['producto_id'],
                        'cantidad'      => $item['cantidad'],
                        'precio_u'      => $item['precio_u'],
                        'precio_t'      => $item['precio_t'],
                    ]);
            });
        });
        $this->alert('success', 'Se actualizo la compra con exito',['timerProgressBar' => true]);
        return redirect()->route('compras');
    }
}
