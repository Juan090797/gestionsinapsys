<?php

namespace App\Http\Livewire;

use App\Exports\ProductosExport;
use App\Imports\ProductosImport;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Clasificacion;
use App\Models\UnidadMedida;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Productos extends ComponenteBase
{
    use WithFileUploads;
    use LivewireAlert;
    public $search, $selected_id,$file;
    public $state = [];
    public $marcas,$clasificaciones,$unidades;
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function  updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        if(strlen($this->search) > 3) {
            $data = Producto::where('codigo', 'like', '%' . $this->search . '%')
                ->where('estado', 'ACTIVO')
                ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                ->orWhere('nombre', 'like', '%' . $this->search . '%')
                ->paginate($this->pagination);
        }else {
            $data = Producto::where('estado', 'ACTIVO')->paginate($this->pagination);
        }
        $this->update();
        return view('livewire.productos.index',['productos' => $data])->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->marcas();
        $this->clasificaciones();
        $this->unidades();
    }
    public function marcas()
    {
        $this->marcas = Marca::all();
    }
    public function clasificaciones()
    {
        $this->clasificaciones = Clasificacion::all();
    }
    public function unidades()
    {
        $this->unidades = UnidadMedida::all();
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
        $this->emit('hide-modal');
        $this->alert('success', 'Producto creado!!',['timerProgressBar' => true]);
    }
    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->file = null;
        $this->resetValidation();
    }
    public function Edit(Producto $producto)
    {
        $this->selected_id = $producto->id;
        $this->state = $producto->toArray();
        $this->emit('show-modal', 'show-modal!');
    }
    public function actualizar()
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
        $this->emit('hide-modal');
        $this->alert('success', 'Producto actualizado!!',['timerProgressBar' => true]);
    }
    public function Destroy(Producto $producto)
    {
        $producto->update(['estado' => 'INACTIVO']);
        $this->alert('success', 'Producto eliminado!!',['timerProgressBar' => true]);
        $this->resetUI();
    }
    public function exportarProductos()
    {
        $reportName = 'Productos_' . uniqid() . '.xlsx';
        return Excel::download(new ProductosExport, $reportName);
    }
    public function importProducto()
    {
        $import = new ProductosImport();
        $import->import($this->file);

        if ($import->failures()->isNotEmpty())
        {
            $this->resetUI();
            $this->alert('error', 'Error en la importacion!!',['timerProgressBar' => true]);
        }else{
            $this->resetUI();
            $this->alert('success', 'Importacion exitosa!!',['timerProgressBar' => true]);
        }
    }
}
