<?php

namespace App\Http\Livewire;

use App\Models\impuesto;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Impuestos extends ComponenteBase
{
    use LivewireAlert;
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
        $this->emit('show-modal');
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
        $this->emit('hide-modal');
        $this->alert('success', 'Impuesto registrado!!',['timerProgressBar' => true]);
    }
    public function resetUI()
    {
        $this->state =[];
        $this->selected_id = '';
        $this->resetValidation();
    }
    public function Destroy(impuesto $impuesto)
    {
        $impuesto->delete();
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Impuesto eliminado!!',['timerProgressBar' => true]);
    }
}
