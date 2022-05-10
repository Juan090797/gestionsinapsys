<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Marcas extends ComponenteBase
{
    use LivewireAlert;
    public $search, $selected_id;
    public $state = [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function render()
    {
        $data = Marca::all();
        return view('livewire.marcas.marcas', ['marcas' => $data])->extends('layouts.tema.app')->section('content');
    }
    public function Edit(Marca $marca)
    {
        $this->selected_id = $marca->id;
        $this->state = $marca->toArray();
        $this->emit('show-modal');
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
        $this->emit('hide-modal');
        $this->alert('success', 'Marca registrada!!',['timerProgressBar' => true]);
    }
    public function actualizar()
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
        $this->emit('hide-modal');
        $this->alert('success', 'Marca actualizada!!',['timerProgressBar' => true]);
    }
    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
    public function Destroy(Marca $marca)
    {
        $pro = Producto::where('marca_id', $marca->id)->count();
        if ($pro == 0) {
            $marca->delete();
            $this->resetUI();
            $this->alert('success', 'Marca eliminada!!',['timerProgressBar' => true]);
        }else {
            $this->resetUI();
            $this->alert('success', 'La marca esta relacionado con productos, no se puede eliminar',['timerProgressBar' => true]);
        }
    }

}
