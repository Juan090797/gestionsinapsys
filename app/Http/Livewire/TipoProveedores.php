<?php

namespace App\Http\Livewire;

use App\Models\TipoProveedor;
use Illuminate\Support\Facades\Validator;

class TipoProveedores extends ComponenteBase
{
    public $selected_id;
    public $state = [];

    public function mount()
    {
        $this->selected_id = 0;
    }

    public function render()
    {
        $tipos = TipoProveedor::orderBy('id', 'desc')->paginate($this->pagination);
        return view('livewire.tipoproveedores.index', ['tipos' => $tipos])->extends('layouts.tema.app')->section('content');
    }

    public function Edit(TipoProveedor $tipoProveedor)
    {
        $this->selected_id = $tipoProveedor->id;
        $this->state = $tipoProveedor->toArray();

        $this->emit('show-modal', 'show-modal!');
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
        $this->emit('marca-added', 'Tipo de proveedor Registrado');
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
        $this->emit('marca-updated', 'Tipo de proveedor Actualizado');

    }

    public function resetUI()
    {
        $this->state=[];
        $this->selected_id = 0;
        $this->resetValidation();
    }
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(TipoProveedor $tipoProveedor)
    {
        $tipoProveedor->delete();
        $this->resetUI();
        $this->emit('marca-deleted', 'Tipo de proveedor eliminado');
    }
}
