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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateCompra extends Component
{
    use CalcularCompra;
    use DataCompra;
    public $state = [];
    public $productos,$proveedores,$costos,$documentos;

    public function render()
    {
        $this->update();
        return view('livewire.compras.create-compra')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->products();
        $this->proveedors();
        $this->costs();
        $this->documentos();
    }

    public function products()
    {
        $this->productos = Producto::all();
    }
    public function proveedors()
    {
        $this->proveedores = Proveedor::all();
    }
    public function costs()
    {
        $this->costos = CentroCosto::all();
    }
    public function documentos()
    {
        $this->documentos = TipoDocumento::where('tipo','pago')->get();
    }

    public function createCompra()
    {
        $validated = Validator::make($this->state, [
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

        $validated['tipo_documento_id'] = $this->tipo_documento_id;
        $validated['periodo'] =  Carbon::now()->format('Ym').''.'00';
        $validated['estado'] = 'PENDIENTE';
        $validated['otros_gastos'] = $this->otros_gastos;
        $validated['icbper'] = $this->icbper;
        $validated['subtotal'] = $this->subTotal;
        $validated['impuesto'] = $this->impuestoD;
        $validated['total'] = $this->total;
        $validated['total_items'] = $this->cantidadTotal;
        $input = $this->lista;

        DB::transaction(function() use ($validated, $input) {
            $compra = Compra::create($validated);
            collect($input)->filter(function ($item) {
                    return $item['producto_id'] !== '';
                })->each(function($item) use($compra) {
                    CompraDetalle::create([
                        'compra_id'     => $compra->id,
                        'producto_id'   => $item['id'],
                        'cantidad'      => $item['cantidad'],
                        'precio_u'      => $item['precio_u'],
                        'precio_t'      => $item['precio_t'],
                    ]);
                });
        });
        $this->emit('compra-registrada', 'Compra Registrada');
        return redirect()->route('compras');
    }



}
