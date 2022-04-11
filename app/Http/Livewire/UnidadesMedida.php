<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use App\Models\UnidadMedida;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UnidadesMedida extends ComponenteBase
{
    use LivewireAlert;
    public $search, $selected_id;
    public $state = [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function render()
    {
        $unidades = UnidadMedida::orderBy('id', 'desc')->paginate($this->pagination);
        return view('livewire.unidades.index',['unidades' => $unidades])->extends('layouts.tema.app')->section('content');
    }

    public function Edit(UnidadMedida $unidadMedida)
    {
        $this->selected_id = $unidadMedida->id;
        $this->state = $unidadMedida->toArray();
        $this->emit('show-modal');
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
        $this->emit('hide-modal' );
        $this->alert('success', 'Unidad registrada!!',['timerProgressBar' => true]);
    }
    public function actualizar()
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
        $this->emit('hide-modal');
        $this->alert('success', 'Unidad actualizada!!',['timerProgressBar' => true]);
    }
    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
    public function Destroy(UnidadMedida $unidadMedida)
    {
        $pro = Producto::where('unidad_medidas_id', $unidadMedida->id)->count();
        if ($pro == 0) {
            $unidadMedida->delete();
            $this->resetUI();
            $this->alert('success', 'Unidad eliminada!!',['timerProgressBar' => true]);
        }else {
            $this->resetUI();
            $this->alert('error', 'La unidad esta relacionado con productos, no se puede eliminar!!',['timerProgressBar' => true]);
        }

    }
}
