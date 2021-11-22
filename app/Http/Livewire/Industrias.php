<?php

namespace App\Http\Livewire;

use App\Models\Industria;
use Livewire\Component;
use Livewire\WithPagination;

class Industrias extends Component
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
            $data = Industria::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = Industria::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.industrias.industrias', ['industrias' => $data])->extends('layouts.tema.app')->section('content');
    }
    public function Edit($id)
    {
        $record = Industria::find($id, ['id', 'nombre', 'estado']);
        $this->nombre = $record->nombre;
        $this->estado = $record->estado;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show-modal!');
    }

    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:industrias|min:3',
            'estado' => 'required',
        ];
        $messages =[
            'nombre.required' => 'Nombre de la Industria es requerido',
            'nombre.unique' => 'Ya existe el nombre de la Industria',
            'nombre.min' => 'El nombre de la Industria debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ];

        $this->validate($rules, $messages);

        $industria = Industria::create([
            'nombre' => $this->nombre,
            'estado' => $this->estado,
        ]);

        $this->resetUI();
        $this->emit('industria-added', 'Industria Registrada');
    }

    public function Update()
    {
        $rules = [
            'nombre' => "required||min:3|unique:industrias,nombre,{$this->selected_id}",
            'estado' => 'required|not_in:Elegir',
        ];
        $messages =[
            'nombre.required' => 'Nombre de la Industria es requerido',
            'nombre.unique' => 'Ya existe el nombre de la Industria',
            'nombre.min' => 'El nombre de la Industria debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ];
        $this->validate($rules, $messages);
        $industria = Industria::find($this->selected_id);
        $industria->update([
            'nombre' => $this->nombre,
            'estado' => $this->estado,
        ]);

        $this->resetUI();
        $this->emit('industria-updated', 'Industria Actualizada');

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

    public function Destroy(Industria $industria)
    {
        $industria->delete();

        $this->resetUI();
        $this->emit('industria-deleted', 'Industria Eliminada');
    }
}
