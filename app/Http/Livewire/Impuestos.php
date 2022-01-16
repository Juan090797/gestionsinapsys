<?php

namespace App\Http\Livewire;

use App\Models\impuesto;
use Illuminate\Support\Facades\Validator;

class Impuestos extends ComponenteBase
{
    public $selected_id;
    public $state= [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function render()
    {
        $data = impuesto::paginate($this->pagination);
        return view('livewire.impuestos.index', ['impuestos' => $data])->extends('layouts.tema.app')->section('content');
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre' => 'required',
            'valor' => 'required|numeric|between:0,99.99',
            'estado' => 'required',
        ])->validate();

        impuesto::create($validated);
        $this->resetUI();
        $this->emit('impuesto-added', 'Impuesto Registrado');
    }
    public function Edit(impuesto $impuesto)
    {
        $this->selected_id = $impuesto->id;
        $this->state = $impuesto->toArray();
        $this->emit('show-modal', 'show-modal!');
    }
    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'nombre' => 'required',
            'valor' => 'required|numeric|between:0,99.99',
            'estado' => 'nullable',
        ])->validate();

        $tax = impuesto::findOrFail($this->state['id']);
        $tax->update($validated);
        $this->emit('impuesto-updated', 'Impuesto Registrado');
    }

    public function Destroy(impuesto $impuesto)
    {
        $impuesto->delete();
        $this->resetUI();
        $this->emit('impuesto-deleted', 'Impuesto Eliminado');
    }

    public function resetUI()
    {
        $this->state =[];
        $this->selected_id = '';
        $this->resetValidation();
    }
}
