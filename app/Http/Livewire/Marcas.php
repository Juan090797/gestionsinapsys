<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use Livewire\Component;
use Livewire\WithPagination;

class Marcas extends Component
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
            $data = Marca::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = Marca::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.marcas.marcas', ['marcas' => $data])->extends('layouts.tema.app')->section('content');
    }
    public function Edit($id)
    {
        $record = Marca::find($id, ['id', 'nombre', 'estado']);
        $this->nombre = $record->nombre;
        $this->estado = $record->estado;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show-modal!');
    }

    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:marcas|min:3',
            'estado' => 'required',
        ];
        $messages =[
            'nombre.required' => 'Nombre de la marca es requerido',
            'nombre.unique' => 'Ya existe el nombre de la marca',
            'nombre.min' => 'El nombre de la marca debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ];

        $this->validate($rules, $messages);

        $marca = Marca::create([
            'nombre' => $this->nombre,
            'estado' => $this->estado,
        ]);

        $this->resetUI();
        $this->emit('marca-added', 'Marca Registrada');
    }

    public function Update()
    {
        $rules = [
            'nombre' => "required||min:3|unique:marcas,nombre,{$this->selected_id}",
            'estado' => 'required|not_in:Elegir',
        ];
        $messages =[
            'nombre.required' => 'Nombre de la marca es requerido',
            'nombre.unique' => 'Ya existe el nombre de la marca',
            'nombre.min' => 'El nombre de la marca debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ];
        $this->validate($rules, $messages);
        $marca = Marca::find($this->selected_id);
        $marca->update([
            'nombre' => $this->nombre,
            'estado' => $this->estado,
        ]);

        $this->resetUI();
        $this->emit('marca-updated', 'Marca Actualizada');

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

    public function Destroy(Marca $marca)
    {
        $marca->delete();

        $this->resetUI();
        $this->emit('marca-deleted', 'Marca Eliminada');
    }
}
