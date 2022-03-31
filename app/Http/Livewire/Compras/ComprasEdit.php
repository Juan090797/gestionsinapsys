<?php

namespace App\Http\Livewire\Compras;

use App\Http\Livewire\Compras\Traits\CalcularCompra;
use App\Http\Livewire\Compras\Traits\DataCompra;
use App\Models\CentroCosto;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TipoDocumento;
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
    public $movimiento,$old, $proveedores,$costos,$productos;

    public function mount(Compra $compra)
    {
        $this->old = $compra;
        $this->state = $compra->toArray();
        $this->lista = $compra->compraDetalles->toArray();
        $this->cantidadTotal = $compra->total_items;
    }
    public function render()
    {
        $this->update();
        return view('livewire.compras.compras-edit')->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->proveedores();
        $this->costos();
        $this->productos();
        $this->documentos();
    }

    public function proveedores()
    {
        $this->proveedores = Proveedor::all();
    }

    public function costos()
    {
        $this->costos = CentroCosto::all();
    }
    public function productos()
    {
        $this->productos = Producto::all();
    }
    public function documentos()
    {
        $this->documentos = TipoDocumento::where('tipo', 'pago')->get();
    }

    public function actualizarCompra()
    {
        $validated = Validator::make($this->state, [
            'tipo_documento_id' => 'required',
            'serie_documento'   => 'required',
            'numero_documento'  => 'required',
            'fecha_documento'   => 'required',
            'fecha_pago'        => 'required',
            'proveedor_id'      => 'required',
            'centro_costo_id'   => 'required',
            'moneda'            => 'required',
            'tipo_cambio'       => '',
            'detalle'           => '',
            'subtotal'          => '',
            'impuesto'          => '',
            'no_gravadas'       => '',
            'icbper'            => '',
            'otros_gastos'      => '',
            'total'             => 'required',
        ],[
            'tipo_documento_id.required'=> 'El tipo de documento es requerido',
            'serie_documento.required'  => 'La serie del documento es requerido',
            'numero_documento.required' => 'El numero del documento es requerido',
            'fecha_documento.required'  => 'La fecha del documento es requerido',
            'fecha_pago.required'       => 'La fecha de pago es requerido',
            'proveedor_id.required'     => 'El proveedor es requerido',
            'centro_costo_id.required'  => 'El centro de costo es requerido',
            'moneda.required'           => 'La moneda es requerida',
            'total.required'            => 'El total es requerido',
        ])->validate();

        $validated['estado'] = 'PENDIENTE';
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
