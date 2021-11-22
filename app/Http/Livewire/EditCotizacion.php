<?php

namespace App\Http\Livewire;

use App\Contracts\Admin\Cotizaciones\UpdatesCotizaciones;
use App\Http\Livewire\Cotizaciones\Traits\CalcularCotizacion;
use App\Http\Livewire\Cotizaciones\Traits\DataCotizacion;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\impuesto;
use App\Models\Producto;
use App\Models\Cotizacion;
use Livewire\Component;

class EditCotizacion extends Component
{
    use DataCotizacion;
    use CalcularCotizacion;

    public $cotizacion;
    public $CotizacionItem;
    public $impuesto;
    public $billedTo = [];
    public $state = [];
    public $code;

    public function mount(Cotizacion $cotizacion)
    {
        $this->cotizacion = $cotizacion;

        $this->CotizacionItem = $cotizacion->CotizacionItem;

        $this->impuesto = impuesto::find($cotizacion->impuesto_id);

        $this->state = $cotizacion->toArray();

        $this->rows = $cotizacion->CotizacionItem->toArray();

        $this->total = $cotizacion->total;

        $this->getClientInfo($this->cotizacion->cliente_id);

        $this->calculateSubTotal();

        $this->calculateTaxAmount($this->impuesto->id ?? null);
    }

    public function getClientInfo($clientId)
    {
        $this->billedTo = Cliente::findOrFail($clientId)->toArray();
    }

    public function updateCoti(UpdatesCotizaciones $updater)
    {
        $updater->update($this->cotizacion,
            array_merge($this->state, [
                'subtotal'          => $this->subTotal,
                'total'             => $this->total,
                'impuesto'          => $this->impuestoD,
                'cotizacion_items'  => $this->rows,
            ]),
        );

        $this->emit('updated-cotizacion', 'Se actualizo la Cotizacion ');
    }

    public function render()
    {
        $empresa = Empresa::all()->first();
        $clientes = Cliente::latest()->paginate();
        $cotizacionNumber = Cotizacion::latest()->first()->id ?? 0 + 1;
        $productos = Producto::latest()->get();
        $impuestos = impuesto::latest()->get();
        return view('livewire.cotizacion.edit-cotizacion',
        [
            'clientes'          => $clientes,
            'cotizacionNumber'  => $cotizacionNumber,
            'productos'         => $productos,
            'impuestos'         => $impuestos,
            'empresa'           => $empresa
        ]

        )->extends('layouts.tema.app')->section('content');
    }
}
