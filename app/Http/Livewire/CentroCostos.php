<?php

namespace App\Http\Livewire;

use App\Models\CentroCosto;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CentroCostos extends ComponenteBase
{
    use LivewireAlert;
    public $selected_id;
    public $state = [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function render()
    {
        $data = CentroCosto::orderBy('id', 'desc')->paginate($this->pagination);
        return view('livewire.centrocostos.index', ['costos' => $data])->extends('layouts.tema.app')->section('content');
    }
    public function Edit(CentroCosto $centroCosto)
    {
        $this->selected_id = $centroCosto->id;
        $this->state = $centroCosto->toArray();
        $this->emit('show-modal', 'show-modal!');
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre' => 'required|unique:centro_costos|min:3',
            'estado' => 'required',
        ],[
            'nombre.required' => 'El nombre del centro de costo es requerido',
            'nombre.unique' => 'Ya existe el nombre del centro de costo',
            'nombre.min' => 'El nombre del centro de costo debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ])->validate();

        CentroCosto::create($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Centro de costo registrado!!',['timerProgressBar' => true]);
    }

    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'nombre' => "required||min:3|unique:centro_costos,nombre,{$this->selected_id}",
            'estado' => 'required',
        ],[
            'nombre.required' => 'El nombre del centro de costo es requerido',
            'nombre.unique' => 'Ya existe el nombre del centro de costo',
            'nombre.min' => 'El nombre del centro de costo debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ])->validate();

        $centroCosto = CentroCosto::findOrFail($this->state['id']);
        $centroCosto->update($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Centro de costo actualizado!!',['timerProgressBar' => true]);
    }

    public function resetUI()
    {
        $this->state=[];
        $this->selected_id = 0;
        $this->resetValidation();
    }

    public function Destroy(CentroCosto $centroCosto)
    {
        $centroCosto->delete();
        $this->resetUI();
        $this->alert('success', 'Centro de costo eliminado!!',['timerProgressBar' => true]);

    }
}
