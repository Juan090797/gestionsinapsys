<?php

namespace App\Http\Livewire\Importaciones;

use App\Models\Gasto;
use App\Models\Purchase;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ShowCosto extends Component
{
    Use LivewireAlert;
    public $orden,$selected_id,$sumaOrigen,$sumaDestino,$sumaAgenciamiento,$sumaDerecho;
    public $state=[];

    public function mount(Purchase $purchase)
    {
        $this->orden = Purchase::with('costos.gastos')->find($purchase->id);
    }
    public function render()
    {
        $this->update();
        return view('livewire.importaciones.show-costo')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->sumaOrigen();
        $this->sumaDestino();
        $this->sumaAgenciamiento();
        $this->sumaDerecho();
    }
    public function sumaOrigen()
    {
        $origen = $this->orden->gastos()->where('tipo', 'ORIGEN')->get();
        $this->sumaOrigen = $origen->sum('total');
    }
    public function sumaDestino()
    {
        $destino = $this->orden->gastos()->where('tipo', 'DESTINO')->get();
        $this->sumaDestino = $destino->sum('total');
    }
    public function sumaAgenciamiento()
    {
        $agenciamiento = $this->orden->gastos()->where('tipo', 'AGENCIAMIENTO')->get();
        $this->sumaAgenciamiento = $agenciamiento->sum('total');
    }
    public function sumaDerecho()
    {
        $derecho = $this->orden->gastos()->where('tipo', 'DERECHO')->get();
        $this->sumaDerecho = $derecho->sum('total');
    }
    public function Store()
    {
        $validated = Validator::make($this->state, [
            'concepto'  => 'required',
            'tipo'      => 'required',
            'cantidad'  => '',
            'subtotal'  => 'required',
            'igv'       => 'required',
            'total'     => 'required',
            'costo_id'  => 'required',
        ],[
            'concepto.required' => 'El concepto es requerido',
            'tipo.required'     => 'El tipo es requerido',
            'subtotal.required' => 'El subtotal es requerido',
            'igv.required'      => 'El igv es requerido',
            'total.required'    => 'El total es requerido',
            'costo_id.required' => 'El costo es requerido',
        ])->validate();
        Gasto::create($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Gasto registrado!!',['timerProgressBar' => true]);
    }
    public function resetUI()
    {
        $this->state=[];
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
