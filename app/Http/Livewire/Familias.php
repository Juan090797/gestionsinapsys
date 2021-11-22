<?php

namespace App\Http\Livewire;

use App\Models\Familia;
use Livewire\Component;
use Livewire\WithPagination;

class Familias extends Component
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
            $data = Familia::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = Familia::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.familias.familias', ['familias' => $data])->extends('layouts.tema.app')->section('content');
    }
    public function Edit($id)
    {
        $record = Familia::find($id, ['id', 'nombre', 'estado']);
        $this->nombre = $record->nombre;
        $this->estado = $record->estado;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show-modal!');
    }

    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:familias|min:3',
            'estado' => 'required',
        ];
        $messages =[
            'nombre.required' => 'Nombre de la familia es requerido',
            'nombre.unique' => 'Ya existe el nombre de la familia',
            'nombre.min' => 'El nombre de la familia debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ];

        $this->validate($rules, $messages);

        $familia = Familia::create([
            'nombre' => $this->nombre,
            'estado' => $this->estado,
        ]);

        $this->resetUI();
        $this->emit('familia-added', 'Familia Registrada');
    }

    public function Update()
    {
        $rules = [
            'nombre' => "required||min:3|unique:familias,nombre,{$this->selected_id}",
            'estado' => 'required|not_in:Elegir',
        ];
        $messages =[
            'nombre.required' => 'Nombre de la familia es requerido',
            'nombre.unique' => 'Ya existe el nombre de la familia',
            'nombre.min' => 'El nombre de la familia debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ];
        $this->validate($rules, $messages);

        $familia = Familia::find($this->selected_id);
        $familia->update([
            'nombre' => $this->nombre,
            'estado' => $this->estado,
        ]);

        $this->resetUI();
        $this->emit('familia-updated', 'Familia Actualizada');

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

    public function Destroy(Familia $familia)
    {
        $familia->delete();

        $this->resetUI();
        $this->emit('familia-deleted', 'Familia Eliminada');
    }
}
