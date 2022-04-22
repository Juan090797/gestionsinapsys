<?php

namespace App\Http\Livewire\Garantias;

use App\Http\Livewire\ComponenteBase;
use App\Models\Cliente;
use App\Models\Garantia;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ListaGarantias extends ComponenteBase
{
    use LivewireAlert;
    public $garantias, $selected_id,$clientes,$productos;

    public function render()
    {
        $this->update();
        return view('livewire.garantias.lista-garantias')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->garantias();
        $this->clientes();
        $this->productos();
    }
    public function garantias()
    {
        $this->garantias = Garantia::all();
    }
    public function clientes()
    {
        $this->clientes = Cliente::where('estado','ACTIVO')->get();
    }
    public function productos()
    {
        $this->productos = Producto::where(['estado' => 'ACTIVO', 'clasificacions_id' => 2])->get();
    }
    public function Edit(Garantia $garantia)
    {
        $this->selected_id = $garantia->id;
        $this->state = $garantia->toArray();
        $this->emit('show-modal');
    }
    public function resetUI()
    {
        $this->state=[];
        $this->selected_id = 0;
        $this->resetValidation();
    }
    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'cliente_id'        => "required",
            'producto_id'       => 'required',
            'estado'            => "required",
            'prioridad'         => 'required',
            'tiempo_garantia'   => '',
            'fin_garantia'      => '',
            'orden_compra'      => '',
            'mant_total'        => '',
        ],[
            'cliente_id.required'   => 'El cliente es requerido',
            'producto_id.unique'    => 'El producto es requerido',
            'estado.min'            => 'El estado es requerido',
            'prioridad.required'    => 'La prioridad es requerida',
        ])->validate();

        $garantia = Garantia::findOrFail($this->state['id']);
        $garantia->update($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Garantia actualizada!!',['timerProgressBar' => true]);
    }
}
