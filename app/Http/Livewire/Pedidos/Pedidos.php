<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\Pedido;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Pedidos extends Component
{
    use WithFileUploads;

    public $selectedProducts = [];
    public $selected_id, $ordencompra,$fechaplazo, $numeroPedido, $guia;

    public function render()
    {
        $pedidos = Pedido::with('pedidoDetalle')->latest()->get();
        return view('livewire.pedidos.index', ['pedidos' => $pedidos])->extends('layouts.tema.app')->section('content');
    }

    public function resetUI()
    {
        $this->selectedProducts =[];
        $this->selected_id = '';
        $this->ordencompra = '';
        $this->guia = '';
        $this->fechaplazo = '';
        $this->resetValidation();
    }

    public function AbrirOrdenCompra()
    {
        if(count($this->selectedProducts))
        {
            $this->selected_id = 1;
            $pedido = Pedido::find($this->selectedProducts);
            $pedido = $pedido[0];
            $this->numeroPedido = $pedido->codigo;
            $this->emit('show-modal-oc', 'show-modal!');
        }else {
            $this->emit('error-oc', 'Selecciona un pedido');
        }

    }
    public function AgregarOrdenCompra()
    {
        $rules = [
            'ordencompra' => 'required',
            'fechaplazo'  => 'required',
        ];
        $messages =[
            'ordencompra.required' => 'La orden de compra es requerida',
            'fechaplazo.required' => 'La orden de compra es requerida',
        ];
        $this->validate($rules, $messages);

        $pedido = Pedido::find($this->selectedProducts);
        $pedido = $pedido[0];

        $name = $this->ordencompra->getClientOriginalName();
        $this->ordencompra->storeAs('ordenescompras', $name);
        $pedido->update([
            'ordencompra' => $name,
            'fecha_entrega'  => $this->fechaplazo,
        ]);
        $this->resetUI();
        $this->emit('oc-added', 'Orden de compra agregada');
    }

    public function descargaOc(Pedido $pedido)
    {
        $ocdesc = $pedido->ordencompra;
        return Storage::disk('local')->download('ordenescompras/'.$ocdesc);
    }

    public function AbrirGuia()
    {
        if(count($this->selectedProducts))
        {
            $this->selected_id = 1;
            $pedido = Pedido::find($this->selectedProducts);
            $pedido = $pedido[0];
            $this->numeroPedido = $pedido->codigo;
            $this->emit('show-modal-guia', 'show-modal!');
        }else{
            $this->emit('error-guia', 'Selecciona un pedido');
        }
    }
    public function AgregarGuia()
    {
        $rules = [
            'guia' => 'required',
        ];
        $messages =[
            'guia.required' => 'La guia es requerida',
        ];
        $this->validate($rules, $messages);

        $pedido = Pedido::find($this->selectedProducts);
        $pedido = $pedido[0];

        $name = $this->guia->getClientOriginalName();
        $this->guia->storeAs('guiasremision', $name);
        $pedido->update([
            'guiaremision' => $name,
        ]);
        $this->resetUI();
        $this->emit('guia-added', 'Guia de remision agregada');
    }

    public function descargaGuia(Pedido $pedido)
    {
        $guiadesc = $pedido->guiaremision;
        return Storage::disk('local')->download('guiasremision/'.$guiadesc);
    }
}
