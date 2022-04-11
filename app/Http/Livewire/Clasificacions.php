<?php

namespace App\Http\Livewire;

use App\Models\Clasificacion;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Clasificacions extends ComponenteBase
{
    use LivewireAlert;
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
        $this->emit('hide-modal');
        $this->alert('success', 'Clasificacion registrada!!',['timerProgressBar' => true]);
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
        $this->emit('hide-modal');
        $this->alert('success', 'Clasificacion actualizada!!',['timerProgressBar' => true]);
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
        $pro = Producto::where('clasificacions_id', $clasificacion->id)->count();
        if ($pro == 0) {
            $clasificacion->delete();
            $this->resetUI();
            $this->alert('success', 'Clasificacion eliminada!!',['timerProgressBar' => true]);
        }else {
            $this->resetUI();
            $this->alert('error', 'La clasificacion esta relacionado con productos, no se puede eliminar',['timerProgressBar' => true]);
        }
    }
}
