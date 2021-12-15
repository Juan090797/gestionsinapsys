<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UnidadMedida;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;

class UnidadesMedida extends Component
{
    use WithPagination;

    public $search, $selected_id;
    public $state = [];
    Private $pagination = 5;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $unidades = UnidadMedida::orderBy('id', 'desc')->paginate($this->pagination);
        return view('livewire.unidades.index', ['unidades' => $unidades])->extends('layouts.tema.app')->section('content');
    }

    public function Edit($id)
    {
        $unidad = UnidadMedida::find($id);
        $this->selected_id = $unidad->id;
        $this->state = $unidad->toArray();

        $this->emit('show-modal', 'show-modal!');
    }


    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre' => 'required|unique:unidad_medidas|min:3',
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre de la unidad es requerido',
            'nombre.unique' => 'Ya existe el nombre de la unidad',
            'nombre.min' => 'El nombre de la unidad debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ])->validate();
        UnidadMedida::create($validated);
        $this->resetUI();
        $this->emit('unidad-added', 'Unidad Registrada');
    }

    public function Update()
    {
        $validated = Validator::make($this->state, [
            'nombre' => "required||min:3|unique:marcas,nombre,{$this->selected_id}",
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre de la unidad es requerido',
            'nombre.unique' => 'Ya existe el nombre de la unidad',
            'nombre.min' => 'El nombre de la unidad debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ])->validate();

        $unidad = UnidadMedida::findOrFail($this->state['id']);
        $unidad->update($validated);
        $this->resetUI();
        $this->emit('unidad-updated', 'Unidad Actualizada');
    }

    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy($id)
    {
        $unidad = UnidadMedida::find($id);
        $unidad->delete();
        $this->resetUI();
        $this->emit('unidad-deleted', 'Unidad Eliminada');
    }
}
