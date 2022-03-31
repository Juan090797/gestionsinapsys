<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Proyecto;
use App\Models\ProyectoUser;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Proyectos extends ComponenteBase
{
    use LivewireAlert;
    public $selected_id, $search;
    public $state=[];
    public $clientes,$users;

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function  updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->update();
        if(strlen($this->search) > 3) {
            $data = Proyecto::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = Proyecto::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.proyectos.index',['proyectos' => $data])->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->clients();
        $this->users();
    }

    public function clients()
    {
        $this->clientes = Cliente::all();
    }
    public function users()
    {
        $this->users = User::all();
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre'            => 'required|unique:proyectos|min:3',
            'prioridad'         => 'required',
            'team'              => '',
            'ingreso_estimado'  => 'required',
            'gasto_estimado'    => 'required',
            'fecha_inicio'      => 'required',
            'fecha_fin'         => 'required',
            'cliente_id'        => 'required',
            'user_id'           => 'required',
        ],[
            'nombre.required'           => 'Nombre del proyecto es requerido',
            'nombre.unique'             => 'Ya existe el nombre del proyecto',
            'nombre.min'                => 'El nombre del proyecto debe tener al menos 3 caracteres',
            'prioridad.required'        => 'La prioridad es requerida',
            'user_id.riquered'          => 'El lider es requerido',
            'ingreso_estimado.required' => 'El ingreso estimado es requerido',
            'gasto_estimado.required'   => 'El gasto estimado es requerido',
            'fecha_inicio.required'     => 'La fecha de inicio es requerida',
            'fecha_fin.required'        => 'La fecha de fin es requerida',
            'cliente_id.required'       => 'El cliente es requerido'

        ])->validate();
        $validated['etapa_id'] = 1;
        $proyecto = Proyecto::create($validated);
        $this->resetUI();
        $this->emit('proyecto-added');
        $this->alert('success', 'Proyecto creado!!',['timerProgressBar' => true]);
    }

    public function Edit(Proyecto $proyecto)
    {
        $this->selected_id  = $proyecto->id;
        $this->state        = $proyecto->toArray();
        $this->emit('show-modal', 'show-modal!');
    }

    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'nombre'            => "required|min:3|unique:proyectos,nombre,{$this->selected_id}",
            'prioridad'         => 'required',
            'team'              => '',
            'ingreso_estimado'  => 'required',
            'gasto_estimado'    => 'required',
            'fecha_inicio'      => 'required',
            'fecha_fin'         => 'required',
            'cliente_id'        => 'required',
            'user_id'           => 'required'
        ],[
            'nombre.required'       => 'Nombre del proyecto es requerido',
            'nombre.unique'         => 'Ya existe el nombre del proyecto',
            'nombre.min'            => 'El nombre del proyecto debe tener al menos 3 caracteres',
            'prioridad.required'    => 'La prioridad es requerida',

        ])->validate();

        $proyecto = Proyecto::findOrFail($this->state['id']);
        $proyecto->update($validated);
        $this->resetUI();
        $this->emit('proyecto-updated');
        $this->alert('success', 'Proyecto actualizado!!',['timerProgressBar' => true]);
    }

    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    public function Destroy(Proyecto $proyecto)
    {
        $cotis = \App\Models\Cotizacion::where('proyecto_id', $proyecto->id)->count();
        if($cotis == 0)
        {
            $proyecto->delete();
            $this->resetUI();
            $this->emit('proyecto-deleted', 'Proyecto Eliminado');
        }else {
            $this->resetUI();
            $this->emit('error', "El proyecto cuenta con $cotis cotizaciones");
        }

    }
}
