<?php

namespace App\Http\Livewire;

use App\Imports\ProductosImport;
use App\Models\Familia;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Productos extends Component
{
    use WithPagination;

    public $codigo, $modelo, $descripcion, $precio, $tipo, $marcaid,$familiaid,$search, $selected_id;

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
        $rules = [
            'codigo' => 'required|unique:productos',
            'modelo' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'tipo' => 'required',
            'marcaid' => 'required',
            'familiaid' => 'required',
        ];
        $messages =[
            'codigo.required' => 'El Codigo del producto es requerido',
            'codigo.unique' => 'Ya existe el codigo del producto',
            'modelo.required' => 'La modelo es requerido',
            'descripcion.required' => 'La modelo es requerido',
            'precio.required' => 'EL precio es requerido',
            'tipo.required' => 'La tipo es requerido',
            'marcaid.required' => 'La marca es requerida',
            'familiaid.required' => 'EL equipo es requerido',
        ];

        $this->validate($rules, $messages);

        $producto = Producto::create([
            'codigo' => $this->codigo,
            'modelo' => $this->modelo,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'tipo' => $this->tipo,
            'marca_id' => $this->marcaid,
            'familia_id' => $this->familiaid,
        ]);

        $this->resetUI();
        $this->emit('producto-added', 'Producto Registrado');
    }

    public function resetUI()
    {
        $this->codigo = '';
        $this->modelo = '';
        $this->descripcion = '';
        $this->precio = '';
        $this->tipo = '';
        $this->marcaid = 'ELEGIR';
        $this->familiaid = 'ELEGIR';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    public function Edit($id)
    {
        $record = Producto::find($id, ['id', 'codigo', 'modelo','descripcion', 'precio', 'tipo', 'marca_id','familia_id']);
        $this->codigo = $record->codigo;
        $this->modelo = $record->modelo;
        $this->descripcion = $record->descripcion;
        $this->precio = $record->precio;
        $this->tipo = $record->tipo;
        $this->marcaid = $record->marca_id;
        $this->familiaid = $record->familia_id;
        $this->selected_id = $record->id;
        $this->emit('show-modal', 'show-modal!');
    }

    public function Update()
    {
        $rules = [
            'codigo' => "required|unique:productos,codigo,{$this->selected_id}",
            'modelo' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            'tipo' => 'required',
            'marcaid' => 'required',
            'familiaid' => 'required',
        ];
        $messages =[
            'codigo.required' => 'El Codigo del producto es requerido',
            'codigo.unique' => 'Ya existe el codigo del producto',
            'modelo.required' => 'La modelo es requerido',
            'descripcion.required' => 'La modelo es requerido',
            'precio.required' => 'EL precio es requerido',
            'tipo.required' => 'La tipo es requerido',
            'marcaid.required' => 'La marca es requerida',
            'familiaid.required' => 'EL equipo es requerido',
        ];

        $this->validate($rules, $messages);
        $producto = Producto::find($this->selected_id);
        $producto->update([
            'codigo' => $this->codigo,
            'modelo' => $this->modelo,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'tipo' => $this->tipo,
            'marca_id' => $this->marcaid,
            'familia_id' => $this->familiaid,
        ]);

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
