<?php

namespace App\Http\Livewire;

use App\Models\Clasificacion;
use Illuminate\Support\Facades\Validator;

class Clasificacions extends ComponenteBase
{
    public $search, $selected_id;
    public $state = [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function  updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        if(strlen($this->search) > 3) {
            $data = Clasificacion::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = Clasificacion::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.clasificacions.clasificacions', ['clasificacions' => $data])->extends('layouts.tema.app')->section('content');
    }
    public function Edit(Clasificacion $clasificacion)
    {
        $this->selected_id = $clasificacion->id;
        $this->state = $clasificacion->toArray();
        $this->emit('show-modal', 'show-modal!');
    }
    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre' => 'required|unique:clasificacions|min:3',
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre de la clasificacion es requerido',
            'nombre.unique' => 'Ya existe el nombre de la clasificacion',
            'nombre.min' => 'El nombre de la clasificacion debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',

        ])->validate();

        Clasificacion::create($validated);
        $this->resetUI();
        $this->emit('clasificacion-added', 'Clasificacion Registrada');
    }
    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'nombre' => "required||min:3|unique:clasificacions,nombre,{$this->selected_id}",
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre de la clasificacion es requerido',
            'nombre.unique' => 'Ya existe el nombre de la clasificacion',
            'nombre.min' => 'El nombre de la clasificacion debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',

        ])->validate();

        $clasificacion = Clasificacion::findOrFail($this->state['id']);
        $clasificacion->update($validated);
        $this->resetUI();
        $this->emit('clasificacion-updated', 'Clasificacion Actualizada');

    }
    public function resetUI()
    {
        $this->state = [];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
    public function Destroy(Clasificacion $clasificacion)
    {
        $clasificacion->delete();
        $this->resetUI();
        $this->emit('clasificacion-deleted', 'Clasificacion Eliminada');
    }
}
