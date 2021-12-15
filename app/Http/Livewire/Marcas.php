<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Marcas extends Component
{
    use WithPagination;

    public $search, $selected_id;
    public $state = [];
    Private $pagination = 10;
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
            $data = Marca::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = Marca::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.marcas.marcas', ['marcas' => $data])->extends('layouts.tema.app')->section('content');
    }

    public function Edit(Marca $marca)
    {
        $this->selected_id = $marca->id;
        $this->state = $marca->toArray();

        $this->emit('show-modal', 'show-modal!');
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre' => 'required|unique:marcas|min:3',
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre de la marca es requerido',
            'nombre.unique' => 'Ya existe el nombre de la marca',
            'nombre.min' => 'El nombre de la marca debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ])->validate();
        Marca::create($validated);
        $this->resetUI();
        $this->emit('marca-added', 'Marca Registrada');
    }

    public function Update()
    {
        $validated = Validator::make($this->state, [
            'nombre' => "required||min:3|unique:marcas,nombre,{$this->selected_id}",
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre de la marca es requerido',
            'nombre.unique' => 'Ya existe el nombre de la marca',
            'nombre.min' => 'El nombre de la marca debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ])->validate();

        $marca = Marca::findOrFail($this->state['id']);
        $marca->update($validated);
        $this->resetUI();
        $this->emit('marca-updated', 'Marca Actualizada');

    }

    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Marca $marca)
    {
        $marca->delete();
        $this->resetUI();
        $this->emit('marca-deleted', 'Marca Eliminada');
    }
}
