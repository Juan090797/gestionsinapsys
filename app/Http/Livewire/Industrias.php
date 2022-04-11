<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Industria;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Industrias extends ComponenteBase
{
    use LivewireAlert;
    public $search, $selected_id;
    public $state=[];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function  updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if(strlen($this->search) > 3)
        {
            $data = Industria::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = Industria::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.industrias.industrias', ['industrias' => $data])->extends('layouts.tema.app')->section('content');
    }

    public function Edit(Industria $industria)
    {
        $this->selected_id = $industria->id;
        $this->state = $industria->toArray();
        $this->emit('show-modal');
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre' => 'required|unique:industrias|min:3',
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre de la Industria es requerido',
            'nombre.unique' => 'Ya existe el nombre de la Industria',
            'nombre.min' => 'El nombre de la Industria debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',

        ])->validate();

        Industria::create($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Industria registrada!!',['timerProgressBar' => true]);
    }

    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'nombre' => "required|min:3|unique:industrias,nombre,{$this->selected_id}",
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre de la Industria es requerido',
            'nombre.unique' => 'Ya existe el nombre de la Industria',
            'nombre.min' => 'El nombre de la Industria debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',

        ])->validate();

        $industria = Industria::findOrFail($this->state['id']);
        $industria->update($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Industria actualizada!!',['timerProgressBar' => true]);
    }

    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    public function Destroy(Industria $industria)
    {
        $clientes = Cliente::where('industria_id', $industria->id)->count();
        if ($clientes == 0){
            $industria->delete();
            $this->resetUI();
            $this->alert('success', 'Industria eliminada!!',['timerProgressBar' => true]);
        }else {
            $this->resetUI();
            $this->alert('error', 'La industria tiene clientes relacionados, no se puede eliminar',['timerProgressBar' => true]);
        }

    }
}
