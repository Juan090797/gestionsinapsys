<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use Illuminate\Support\Facades\Validator;
use App\Models\TipoProveedor;

class Proveedores extends ComponenteBase
{
    public $search, $selected_id;
    public $state = [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function  updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->update();
        if(strlen($this->search) > 3) {
            $data = Proveedor::where('ruc', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = Proveedor::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.proveedores.index', ['proveedores' => $data])->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->tipos();
    }

    public function tipos()
    {
        $this->tipos = TipoProveedor::all();
    }
    public function Edit(Proveedor $proveedor)
    {
        $this->selected_id = $proveedor->id;
        $this->state = $proveedor->toArray();

        $this->emit('show-modal', 'show-modal!');
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'ruc'                   => 'required|unique:proveedors|min:11',
            'razon_social'          => 'required',
            'nombre_comercial'      => 'required',
            'direccion'             => 'required',
            'telefono'              => 'required',
            'celular'               => 'required',
            'correo'                => 'required',
            'pagina_web'            => 'required',
            'estado'                => 'required',
            'tipo_proveedors_id'    => 'required',
        ],[
            'ruc.required'                  => 'El ruc del proveedor es requerido',
            'ruc.unique'                    => 'Ya existe el ruc',
            'ruc.min'                       => 'El ruc debe tener al menos 11 numeros',
            'razon_social.required'         => 'La razon social es requerido',
            'direccion.required'            => 'La direccion es requerida',
            'telefono.required'             => 'El telefono es requerido',
            'celular.required'              => 'El celular es requerido',
            'correo.required'               => 'El correo es requerido',
            'pagina_web.required'           => 'La pagina web es requerido',
            'tipo_proveedors_id.required'   => 'El tipo de proveedor es requerido',
        ])->validate();
        Proveedor::create($validated);
        $this->resetUI();
        $this->emit('proveedor-added', 'Proveedor Registrado');
    }

    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'ruc'                   => "required||min:11|unique:proveedors,ruc,{$this->selected_id}",
            'razon_social'          => 'required',
            'nombre_comercial'      => 'required',
            'direccion'             => 'required',
            'telefono'              => 'required',
            'celular'               => 'required',
            'correo'                => 'required',
            'pagina_web'            => 'required',
            'estado'                => 'required',
            'tipo_proveedors_id'    => 'required',
        ],[
            'ruc.required'                  => 'El ruc del proveedor es requerido',
            'ruc.unique'                    => 'Ya existe el ruc',
            'ruc.min'                       => 'El ruc debe tener al menos 11 numeros',
            'razon_social.required'         => 'La razon social es requerido',
            'direccion.required'            => 'La direccion es requerida',
            'telefono.required'             => 'El telefono es requerido',
            'celular.required'              => 'El celular es requerido',
            'correo.required'               => 'El correo es requerido',
            'pagina_web.required'           => 'La pagina web es requerido',
            'tipo_proveedors_id.required'   => 'El tipo de proveedor es requerido',
        ])->validate();

        $proveedor = Proveedor::findOrFail($this->state['id']);
        $proveedor->update($validated);
        $this->resetUI();
        $this->emit('proveedor-updated', 'Proveedor Actualizado');

    }

    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    public function Destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        $this->resetUI();
        $this->emit('proveedor-deleted', 'Proveedor Eliminado');
    }
}
