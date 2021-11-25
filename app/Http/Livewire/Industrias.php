<?php

namespace App\Http\Livewire;

use App\Models\Industria;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Industrias extends Component
{
    use WithPagination;

    public $search, $selected_id;
    public $state=[];
    Private $pagination = 5;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->selected_id = 0;
    }

    public function  updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        if(strlen($this->search) > 0) {
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
        $this->emit('show-modal', 'show-modal!');
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
        $this->emit('industria-added', 'Industria Registrada');
    }

    public function Update()
    {
        $validated = Validator::make($this->state, [
            'nombre' => "required||min:3|unique:industrias,nombre,{$this->selected_id}",
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
        $this->emit('industria-updated', 'Industria Actualizada');

    }

    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Industria $industria)
    {
        $industria->delete();
        $this->resetUI();
        $this->emit('industria-deleted', 'Industria Eliminada');
    }
}
