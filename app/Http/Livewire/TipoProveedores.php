<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use App\Models\TipoProveedor;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TipoProveedores extends ComponenteBase
{
    use LivewireAlert;
    public $selected_id;
    public $state = [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function render()
    {
        $tipos = TipoProveedor::where('estado', 'ACTIVO')->paginate($this->pagination);
        return view('livewire.tipoproveedores.index', ['tipos' => $tipos])->extends('layouts.tema.app')->section('content');
    }

    public function Edit(TipoProveedor $tipoProveedor)
    {
        $this->selected_id = $tipoProveedor->id;
        $this->state = $tipoProveedor->toArray();
        $this->emit('show-modal');
    }
    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre' => 'required|unique:tipo_proveedors|min:3',
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre del tipo de proveedor es requerido',
            'nombre.unique' => 'Ya existe el nombre del tipo de proveedor',
            'nombre.min' => 'El nombre del tipo de proveedor debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ])->validate();

        TipoProveedor::create($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Tipo de proveedor creado!!',['timerProgressBar' => true]);
    }
    public function Update()
    {
        $validated = Validator::make($this->state, [
            'nombre' => "required||min:3|unique:tipo_proveedors,nombre,{$this->selected_id}",
            'estado' => 'required',
        ],[
            'nombre.required' => 'Nombre del tipo de proveedor es requerido',
            'nombre.unique' => 'Ya existe el nombre del tipo de proveedor',
            'nombre.min' => 'El nombre del tipo de proveedor debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
        ])->validate();

        $tipoProveedor = TipoProveedor::findOrFail($this->state['id']);
        $tipoProveedor->update($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Tipo de proveedor actualizado!!',['timerProgressBar' => true]);
    }
    public function resetUI()
    {
        $this->state=[];
        $this->selected_id = 0;
        $this->resetValidation();
    }
    public function Destroy(TipoProveedor $tipoProveedor)
    {
        $tipoProveedor->update(['estado' => 'INACTIVO']);
        $this->resetUI();
        $this->alert('success', 'Tipo de proveedor eliminado!!',['timerProgressBar' => true]);
    }
}
