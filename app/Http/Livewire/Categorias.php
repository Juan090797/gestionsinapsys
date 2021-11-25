<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Categorias extends Component
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
            $data = Categoria::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = Categoria::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.categorias.categorias', ['categorias' => $data])->extends('layouts.tema.app')->section('content');
    }
    public function Edit(Categoria $categoria)
    {
        $this->selected_id = $categoria->id;
        $this->state = $categoria->toArray();

        $this->emit('show-modal', 'show-modal!');
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre' => 'required|unique:categorias|min:3',
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre de la categoria es requerido',
            'nombre.unique' => 'Ya existe el nombre de la categoria',
            'nombre.min' => 'El nombre de la categoria debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',

        ])->validate();

        Categoria::create($validated);

        $this->resetUI();
        $this->emit('categoria-added', 'Categoria Registrada');
    }

    public function Update()
    {
        $validated = Validator::make($this->state, [
            'nombre' => "required||min:3|unique:categorias,nombre,{$this->selected_id}",
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre de la categoria es requerido',
            'nombre.unique' => 'Ya existe el nombre de la categoria',
            'nombre.min' => 'El nombre de la categoria debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',

        ])->validate();

        $categoria = Categoria::findOrFail($this->state['id']);
        $categoria->update($validated);

        $this->resetUI();
        $this->emit('categoria-updated', 'Categoria Actualizada');

    }

    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Categoria $categoria)
    {
        $categoria->delete();

        $this->resetUI();
        $this->emit('categoria-deleted', 'Categoria Eliminada');
    }
}
