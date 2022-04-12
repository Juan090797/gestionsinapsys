<?php

namespace App\Http\Livewire\Pedidos\Facturas;

use App\Exports\ComprasExport;
use App\Exports\FacturaVentaExport;
use App\Models\FacturaVenta;
use App\Models\Pedido;
use App\Models\TipoDocumento;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ListaFacturas extends Component
{
    use LivewireAlert;
    public $pedidos, $selected_id, $facturas, $documentos;
    public $state = [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function render()
    {
        $this->update();
        return view('livewire.pedidos.facturas.lista-facturas')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->pedidos();
        $this->facturas();
        $this->documentos();
    }

    public function pedidos()
    {
        $this->pedidos = Pedido::all();
    }
    public function facturas()
    {
        $this->facturas = FacturaVenta::all();
    }
    public function documentos()
    {
        $this->documentos = TipoDocumento::where('tipo','pago')->get();
    }
    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
    public function Store()
    {
        $validated = Validator::make($this->state, [
            'fecha_emision'     => 'required',
            'fecha_pago'        => 'required',
            'serie_documento'   => 'required',
            'numero_documento'  => 'required',
            'subtotal'          => '',
            'igv'               => '',
            'otros_cargos'      => '',
            'total'             => 'required',
            'tipo_cambio'       => '',
            'pedido_id'         => 'required',
            'tipo_documento_id' => 'required',
            'glosa'             => '',
            'moneda'            => 'required',
        ],[
            'fecha_emision.required'    => 'La fecha de emision es requerido',
            'fecha_pago.required'       => 'La fecha de pago es requerido',
            'serie_documento.required'  => 'La serie del documento es requerido',
            'numero_documento.required' => 'El numero de documento es requerido',
            'total.required'            => 'El total es requerido',
            'pedido_id.required'        => 'El pedido es requerido',
            'tipo_documento_id.required'=> 'El tipo de documento es requerido',
            'moneda.required'           => 'La moneda es requerida',
        ])->validate();

        FacturaVenta::create($validated);

        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Factura Registrada',['timerProgressBar' => true]);
    }
    public function Edit(FacturaVenta $facturaVenta)
    {
        $this->selected_id = $facturaVenta->id;
        $this->state = $facturaVenta->toArray();
        $this->emit('show-modal');
    }
    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'fecha_emision'     => 'required',
            'fecha_pago'        => 'required',
            'serie_documento'   => 'required',
            'numero_documento'  => 'required',
            'subtotal'          => '',
            'igv'               => '',
            'otros_cargos'      => '',
            'total'             => 'required',
            'tipo_cambio'       => '',
            'pedido_id'         => 'required',
            'tipo_documento_id' => 'required',
            'glosa'             => '',
            'moneda'            => 'required',
        ],[
            'fecha_emision.required'    => 'La fecha de emision es requerido',
            'fecha_pago.required'       => 'La fecha de pago es requerido',
            'serie_documento.required'  => 'La serie del documento es requerido',
            'numero_documento.required' => 'El numero de documento es requerido',
            'total.required'            => 'El total es requerido',
            'pedido_id.required'        => 'El pedido es requerido',
            'tipo_documento_id.required'=> 'El tipo de documento es requerido',
            'moneda.required'           => 'La moneda es requerida',
        ])->validate();

        $factura = FacturaVenta::findOrFail($this->state['id']);
        $factura->update($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Factura actualizada',['timerProgressBar' => true]);
    }
    public function Destroy(FacturaVenta $facturaVenta)
    {
        $facturaVenta->delete();
        $this->resetUI();
        $this->alert('success', 'Se elimino la factura con exito',['timerProgressBar' => true]);
    }
    public function exportFacturas()
    {
        $reportName = 'Facturas_' . uniqid() . '.xlsx';
        return Excel::download(new FacturaVentaExport, $reportName);
    }
}
