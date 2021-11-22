<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Proyectos extends Component
{
    use WithPagination;

    public $selected_id, $search;
    public $state=[];
    Private $pagination = 5;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->selected_id = 0;
    }

    public function  updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if(strlen($this->search) > 0) {
            $data = Proyecto::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = Proyecto::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.proyectos.index', [
            'proyectos' => $data,
            'clientes'  => Cliente::all(),
            'users'     => User::all()
        ])->extends('layouts.tema.app')->section('content');
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre' => 'required|unique:proyectos|min:3',
            'prioridad' => 'required',
            'team'  => '',
            'ingreso_estimado' => '',
            'gasto_estimado'   => '',
            'fecha_inicio' => '',
            'fecha_fin' => '',
            'cliente_id' => '',
            'user_id' => ''
        ],[
            'nombre.required' => 'Nombre del proyecto es requerido',
            'nombre.unique' => 'Ya existe el nombre del proyecto',
            'nombre.min' => 'El nombre del proyecto debe tener al menos 3 caracteres',
            'prioridad.required' => 'La prioridad es requerida',

        ])->validate();

        Proyecto::create($validated);

        $this->resetUI();
        $this->emit('proyecto-added', 'Proyecto Registrado');
    }

    public function Edit(Proyecto $proyecto)
    {
        $this->selected_id = $proyecto->id;
        $this->state = $proyecto->toArray();

        $this->emit('show-modal', 'show-modal!');
    }


    public function Update()
    {
        $validated = Validator::make($this->state, [
            'nombre' => "required||min:3|unique:proyectos,nombre,{$this->selected_id}",
            'prioridad' => 'required',
            'team'  => '',
            'ingreso_estimado' => '',
            'gasto_estimado'   => '',
            'fecha_inicio' => '',
            'fecha_fin' => '',
            'cliente_id' => '',
            'user_id' => ''
        ],[
            'nombre.required' => 'Nombre del proyecto es requerido',
            'nombre.unique' => 'Ya existe el nombre del proyecto',
            'nombre.min' => 'El nombre del proyecto debe tener al menos 3 caracteres',
            'prioridad.required' => 'La prioridad es requerida',

        ])->validate();

        $proyecto = Proyecto::findOrFail($this->state['id']);
        $proyecto->update($validated);

        $this->resetUI();
        $this->emit('proyecto-updated', 'Proyecto Actualizado');

    }

    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Proyecto $proyecto)
    {
        $proyecto->delete();

        $this->resetUI();
        $this->emit('proyecto-deleted', 'Proyecto Eliminado');
    }
}
