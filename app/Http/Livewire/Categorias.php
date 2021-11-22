<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class Categorias extends Component
{
    use WithPagination;

    public $nombre, $estado, $search, $selected_id;
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
    public function Edit($id)
    {
        $record = Categoria::find($id, ['id', 'nombre', 'estado']);
        $this->nombre = $record->nombre;
        $this->estado = $record->estado;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show-modal!');
    }

    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:categorias|min:3',
            'estado' => 'required',
        ];
        $messages =[
            'nombre.required' => 'Nombre de la categoria es requerido',
            'nombre.unique' => 'Ya existe el nombre de la categoria',
            'nombre.min' => 'El nombre de la categoria debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ];

        $this->validate($rules, $messages);

        $categoria = Categoria::create([
            'nombre' => $this->nombre,
            'estado' => $this->estado,
        ]);

        $this->resetUI();
        $this->emit('categoria-added', 'Categoria Registrada');
    }

    public function Update()
    {
        $rules = [
            'nombre' => "required||min:3|unique:categorias,nombre,{$this->selected_id}",
            'estado' => 'required|not_in:Elegir',
        ];
        $messages =[
            'nombre.required' => 'Nombre de la categoria es requerido',
            'nombre.unique' => 'Ya existe el nombre de la categoria',
            'nombre.min' => 'El nombre de la categoria debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ];
        $this->validate($rules, $messages);
        $categoria = Categoria::find($this->selected_id);
        $categoria->update([
            'nombre' => $this->nombre,
            'estado' => $this->estado,
        ]);

        $this->resetUI();
        $this->emit('categoria-updated', 'Categoria Actualizada');

    }

    public function resetUI()
    {
        $this->nombre = '';
        $this->estado = 'ELEGIR';
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
