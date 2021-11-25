<?php

namespace App\Http\Livewire;

use App\Models\Familia;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Familias extends Component
{
    use WithPagination;

    public $search, $selected_id;
    public $state =[];
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
            $data = Familia::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = Familia::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.familias.familias', ['familias' => $data])->extends('layouts.tema.app')->section('content');
    }

    public function Edit(Familia $familia)
    {
        $this->selected_id = $familia->id;
        $this->state = $familia->toArray();

        $this->emit('show-modal', 'show-modal!');
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre' => 'required|unique:familias|min:3',
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre de la familia es requerido',
            'nombre.unique' => 'Ya existe el nombre de la familia',
            'nombre.min' => 'El nombre de la familia debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',

        ])->validate();

        Familia::create($validated);

        $this->resetUI();
        $this->emit('familia-added', 'Familia Registrada');
    }

    public function Update()
    {
        $validated = Validator::make($this->state, [
            'nombre' => "required||min:3|unique:familias,nombre,{$this->selected_id}",
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre de la familia es requerido',
            'nombre.unique' => 'Ya existe el nombre de la familia',
            'nombre.min' => 'El nombre de la familia debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',

        ])->validate();

        $familia = Familia::findOrFail($this->state['id']);
        $familia->update($validated);

        $this->resetUI();
        $this->emit('familia-updated', 'Familia Actualizada');

    }

    public function resetUI()
    {
        $this->state = [];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Familia $familia)
    {
        $familia->delete();

        $this->resetUI();
        $this->emit('familia-deleted', 'Familia Eliminada');
    }
}
