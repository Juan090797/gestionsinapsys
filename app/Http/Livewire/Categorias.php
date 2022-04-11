<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Categorias extends ComponenteBase
{
    use LivewireAlert;
    public $search, $selected_id;
    public $state=[];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function  updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if(strlen($this->search) > 3) {
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
        $this->emit('show-modal');
    }
    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre' => 'required|unique:categorias|min:3',
            'estado' => 'required',
        ],[
            'nombre.required'   => 'Nombre de la categoria es requerido',
            'nombre.unique'     => 'Ya existe el nombre de la categoria',
            'nombre.min'        => 'El nombre de la categoria debe tener al menos 3 caracteres',
            'estado.required'   => 'El estado es requerido',
        ])->validate();

        Categoria::create($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Categoria registrada!!',['timerProgressBar' => true]);
    }
    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'nombre' => "required||min:3|unique:categorias,nombre,{$this->selected_id}",
            'estado' => 'required',
        ],[
            'nombre.required'   => 'Nombre de la categoria es requerido',
            'nombre.unique'     => 'Ya existe el nombre de la categoria',
            'nombre.min'        => 'El nombre de la categoria debe tener al menos 3 caracteres',
            'estado.required'   => 'El estado es requerido',
        ])->validate();

        $categoria = Categoria::findOrFail($this->state['id']);
        $categoria->update($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Categoria actualizada!!',['timerProgressBar' => true]);
    }
    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
    public function Destroy(Categoria $categoria)
    {
        $clientes = Cliente::where('categoria_id', $categoria->id)->count();
        if ($clientes == 0)
        {
            $categoria->delete();
            $this->resetUI();
            $this->alert('success', 'Categoria eliminada',['timerProgressBar' => true]);
        }else{
            $this->resetUI();
            $this->alert('success', 'La categoria tiene clientes relacionados, no se puede eliminar',['timerProgressBar' => true]);
        }
    }
}
