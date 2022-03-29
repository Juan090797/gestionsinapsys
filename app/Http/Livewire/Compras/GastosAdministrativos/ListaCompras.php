<?php

namespace App\Http\Livewire\Compras\GastosAdministrativos;

use App\Models\CentroCosto;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\TipoDocumento;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ListaCompras extends Component
{
    use LivewireAlert;
    public $compras,$proveedores,$documentos,$costos;
    public $selected_id;
    public $state = [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function render()
    {
        $this->update();
        return view('livewire.compras.gastos-administrativos.lista-compras')->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->compras();
        $this->proveedores();
        $this->documentos();
        $this->costos();
    }

    public function compras()
    {
        $this->compras = Compra::all();
    }
    public function proveedores()
    {
        $this->proveedores = Proveedor::all();
    }
    public function documentos()
    {
        $this->documentos = TipoDocumento::where('tipo','pago')->get();
    }
    public function costos()
    {
        $this->costos = CentroCosto::all();
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
            'serie_documento'   => 'required',
            'tipo_documento_id' => 'required',
            'numero_documento' => 'required',
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
            'serie_documento.required'  => 'La serie del documento es requerido',
            'tipo_documento_id.required'=> 'El tipo de documento es requerido',
            'numero_documento.required' => 'El numero del documento es requerido',
            'fecha_documento.required'  => 'La fecha del documento es requerido',
            'fecha_pago.required'       => 'La fecha de pago es requerido',
            'proveedor_id.required'     => 'El proveedor es requerido',
            'centro_costo_id.required'  => 'El centro de costo es requerido',
            'moneda.required'           => 'La moneda es requerida',
            'total.required'            => 'El total es obligatorio',
        ])->validate();

        $validated['estado'] = 'PENDIENTE';
        $validated['periodo'] =  Carbon::now()->format('Ym').''.'00';
        Compra::create($validated);
        $this->resetUI();
        $this->emit('compra-add');
        $this->alert('success', 'Documento Registrado',['timerProgressBar' => true]);
    }
    public function Edit(Compra $compra)
    {
        $this->selected_id = $compra->id;
        $this->state = $compra->toArray();
        $this->emit('show-modal');
    }
    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'serie_documento'   => 'required',
            'tipo_documento_id' => 'required',
            'numero_documento' => 'required',
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
            'serie_documento.required'  => 'La serie del documento es requerido',
            'tipo_documento_id.required'=> 'El tipo de documento es requerido',
            'numero_documento.required' => 'El numero del documento es requerido',
            'fecha_documento.required'  => 'La fecha del documento es requerido',
            'fecha_pago.required'       => 'La fecha de pago es requerido',
            'proveedor_id.required'     => 'El proveedor es requerido',
            'centro_costo_id.required'  => 'El centro de costo es requerido',
            'moneda.required'           => 'La moneda es requerida',
            'total.required'            => 'El total es obligatorio',
        ])->validate();

        $compra = Compra::findOrFail($this->state['id']);
        $compra->update($validated);
        $this->resetUI();
        $this->emit('compra-updated');
        $this->alert('success', 'Compra actualizada',['timerProgressBar' => true]);
    }

    public function Destroy(Compra $compra)
    {
        $compra->delete();
        $this->resetUI();
        $this->alert('success', 'Se elimino la compra con exito',['timerProgressBar' => true]);
    }
}
