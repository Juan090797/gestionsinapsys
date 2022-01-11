<?php

namespace App\Http\Livewire;

use App\Models\Marca;
use App\Models\Producto;
use App\Models\Clasificacion;
use App\Models\UnidadMedida;
use Illuminate\Support\Facades\Validator;

class Productos extends ComponenteBase
{
    public $search, $selected_id;
    public $state = [];

    public function  updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->selected_id = 0;
    }

    public function render()
    {
        if(strlen($this->search) > 0) {
            $data = Producto::where('codigo', 'like', '%' . $this->search . '%')
                ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                ->orWhere('modelo', 'like', '%' . $this->search . '%')
                ->paginate($this->pagination);
        }else {
            $data = Producto::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.productos.index',[
            'productos' => $data,
            'marcas' => Marca::all(),
            'clasificaciones' => Clasificacion::all(),
            'unidades' => UnidadMedida::all(),
        ])->extends('layouts.tema.app')->section('content');
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'codigo'            => 'required|unique:productos',
            'estado'            => 'required',
            'modelo'            => 'required',
            'nombre'            => 'required',
            'descripcion'       => 'required',
            'precio_venta'      => 'required',
            'tipo'              => 'required',
            'marca_id'          => 'required',
            'clasificacions_id' => 'required',
            'unidad_medidas_id' => '',
        ],
            [
                'codigo.required'               => 'El Codigo del producto es requerido',
                'codigo.unique'                 => 'Ya existe el codigo del producto',
                'estado.unique'                 => 'El estado es obligatorio',
                'modelo.required'               => 'La modelo es requerido',
                'nombre.required'               => 'El nombre del producto es obligatorio',
                'descripcion.required'          => 'La descripcion es requerido',
                'precio_venta.required'         => 'EL precio de ventas es requerido',
                'tipo.required'                 => 'La tipo es requerido',
                'marca_id.required'             => 'La marca es requerida',
                'clasificacions_id.required'    => 'La clasificacion es requerida',
            ])->validate();

        Producto::create($validated);

        $this->resetUI();
        $this->emit('producto-added', 'Producto Registrado');
    }

    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    public function Edit(Producto $producto)
    {
        $this->selected_id = $producto->id;
        $this->state = $producto->toArray();
        $this->emit('show-modal', 'show-modal!');
    }

    public function Update()
    {
        $validated = Validator::make($this->state, [
            'codigo' => "required|unique:productos,codigo,{$this->selected_id}",
            'estado'            => 'required',
            'modelo'            => 'required',
            'nombre'            => 'required',
            'descripcion'       => 'required',
            'precio_venta'      => 'required',
            'tipo'              => 'required',
            'marca_id'          => 'required',
            'clasificacions_id' => 'required',
            'unidad_medidas_id' => '',
        ],
            [
                'codigo.required'               => 'El Codigo del producto es requerido',
                'codigo.unique'                 => 'Ya existe el codigo del producto',
                'estado.unique'                 => 'El estado es obligatorio',
                'modelo.required'               => 'La modelo es requerido',
                'nombre.required'               => 'El nombre del producto es obligatorio',
                'descripcion.required'          => 'La descripcion es requerido',
                'precio_venta.required'         => 'EL precio de ventas es requerido',
                'tipo.required'                 => 'La tipo es requerido',
                'marca_id.required'             => 'La marca es requerida',
                'clasificacions_id.required'    => 'La clasificacion es requerida',
            ])->validate();

        $producto = Producto::findOrFail($this->state['id']);
        $producto->update($validated);

        $this->resetUI();
        $this->emit('producto-updated', 'Producto Actualizado');
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Producto $producto)
    {
        $producto->delete();

        $this->resetUI();
        $this->emit('producto-deleted', 'Producto Eliminado');
    }

}
