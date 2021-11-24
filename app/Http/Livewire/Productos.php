<?php

namespace App\Http\Livewire;

use App\Models\Familia;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Productos extends Component
{
    use WithPagination;

    public $search, $selected_id;
    public $state = [];
    protected $paginationTheme = 'bootstrap';

    Private $pagination = 10;

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
            'familias' => Familia::all(),
        ])->extends('layouts.tema.app')->section('content');
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'codigo' => 'required|unique:productos',
            'modelo' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'tipo' => 'required',
            'marca_id' => 'required',
            'familia_id' => 'required',
        ],
            [
                'codigo.required' => 'El Codigo del producto es requerido',
                'codigo.unique' => 'Ya existe el codigo del producto',
                'modelo.required' => 'La modelo es requerido',
                'descripcion.required' => 'La modelo es requerido',
                'precio.required' => 'EL precio es requerido',
                'tipo.required' => 'La tipo es requerido',
                'marca_id.required' => 'La marca es requerida',
                'familia_id.required' => 'EL equipo es requerido',
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
            'modelo' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'tipo' => 'required',
            'marca_id' => 'required',
            'familia_id' => 'required',
        ],
            [
                'codigo.required' => 'El Codigo del producto es requerido',
                'codigo.unique' => 'Ya existe el codigo del producto',
                'modelo.required' => 'La modelo es requerido',
                'descripcion.required' => 'La modelo es requerido',
                'precio.required' => 'EL precio es requerido',
                'tipo.required' => 'La tipo es requerido',
                'marca_id.required' => 'La marca es requerida',
                'familia_id.required' => 'EL equipo es requerido',
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
