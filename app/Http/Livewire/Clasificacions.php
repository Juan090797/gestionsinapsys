<?php

namespace App\Http\Livewire;

use App\Models\Clasificacion;
use Livewire\Component;
use Livewire\WithPagination;

class Clasificacions extends Component
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
            $data = Clasificacion::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = Clasificacion::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.clasificacions.clasificacions', ['clasificacions' => $data])->extends('layouts.tema.app')->section('content');
    }
    public function Edit($id)
    {
        $record = Clasificacion::find($id, ['id', 'nombre', 'estado']);
        $this->nombre = $record->nombre;
        $this->estado = $record->estado;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show-modal!');
    }

    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:clasificacions|min:3',
            'estado' => 'required',
        ];
        $messages =[
            'nombre.required' => 'Nombre de la clasificacion es requerido',
            'nombre.unique' => 'Ya existe el nombre de la clasificacion',
            'nombre.min' => 'El nombre de la clasificacion debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ];

        $this->validate($rules, $messages);

        $clasificacion = Clasificacion::create([
            'nombre' => $this->nombre,
            'estado' => $this->estado,
        ]);

        $this->resetUI();
        $this->emit('clasificacion-added', 'Clasificacion Registrada');
    }

    public function Update()
    {
        $rules = [
            'nombre' => "required||min:3|unique:clasificacions,nombre,{$this->selected_id}",
            'estado' => 'required|not_in:Elegir',
        ];
        $messages =[
            'nombre.required' => 'Nombre de la clasificacion es requerido',
            'nombre.unique' => 'Ya existe el nombre de la clasificacion',
            'nombre.min' => 'El nombre de la clasificacion debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ];
        $this->validate($rules, $messages);

        $clasificacion = Clasificacion::find($this->selected_id);
        $clasificacion->update([
            'nombre' => $this->nombre,
            'estado' => $this->estado,
        ]);

        $this->resetUI();
        $this->emit('clasificacion-updated', 'Clasificacion Actualizada');

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

    public function Destroy(Clasificacion $clasificacion)
    {
        $clasificacion->delete();

        $this->resetUI();
        $this->emit('clasificacion-deleted', 'Clasificacion Eliminada');
    }
}
