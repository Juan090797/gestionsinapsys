<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Proyecto;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Proyectos extends Component
{
    use WithPagination;

    public $nombre, $prioridad, $ingreso_estimado, $gasto_estimado, $fecha_inicio, $fecha_fin, $clienteid, $userid, $search, $selected_id, $team;
    Private $pagination = 5;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->team = [];
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
        $rules = [
            'nombre' => 'required|unique:proyectos|min:3',
            'prioridad' => 'required',
        ];
        $messages =[
            'nombre.required' => 'Nombre del proyecto es requerido',
            'nombre.unique' => 'Ya existe el nombre del proyecto',
            'nombre.min' => 'El nombre del proyecto debe tener al menos 3 caracteres',
            'prioridad.required' => 'La prioridad es requerida',
        ];

        $this->validate($rules, $messages);

        $proyecto = Proyecto::create([
            'nombre' => $this->nombre,
            'prioridad' => $this->prioridad,
            'ingreso_estimado' => $this->ingreso_estimado,
            'team'             => $this->team,
            'gasto_estimado' => $this->gasto_estimado,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'cliente_id' => $this->clienteid,
            'user_id' => $this->userid,
        ]);

        $this->resetUI();
        $this->emit('proyecto-added', 'Proyecto Registrado');
    }

    public function Edit($id)
    {
        $record = Proyecto::find($id, ['id', 'nombre', 'prioridad', 'ingreso_estimado', 'gasto_estimado', 'fecha_inicio', 'fecha_fin', 'cliente_id', 'user_id', 'team']);
        $this->nombre = $record->nombre;
        $this->prioridad = $record->prioridad;
        $this->selected_id = $record->id;
        $this->ingreso_estimado = $record->ingreso_estimado;
        $this->gasto_estimado = $record->gasto_estimado;
        $this->fecha_inicio = $record->fecha_inicio;
        $this->fecha_fin = $record->fecha_fin;
        $this->team = $record->team;
        $this->clienteid = $record->cliente_id;
        $this->userid = $record->user_id;

        $this->emit('show-modal', 'show-modal!');
    }


    public function Update()
    {
        $rules = [
            'nombre' => "required||min:3|unique:proyectos,nombre,{$this->selected_id}",
            'prioridad' => 'required|not_in:Elegir',
        ];
        $messages =[
            'nombre.required' => 'Nombre del proyecto es requerido',
            'nombre.unique' => 'Ya existe el nombre del proyecto',
            'nombre.min' => 'El nombre del proyecto debe tener al menos 3 caracteres',
            'prioridad.required' => 'La prioridad es requerida',
        ];
        $this->validate($rules, $messages);
        $proyecto = Proyecto::find($this->selected_id);
        $proyecto->update([
            'nombre' => $this->nombre,
            'prioridad' => $this->prioridad,
            'ingreso_estimado' => $this->ingreso_estimado,
            'gasto_estimado' => $this->gasto_estimado,
            'fecha_inicio' => $this->fecha_inicio,
            'team'             => $this->team,
            'fecha_fin' => $this->fecha_fin,
            'cliente_id' => $this->clienteid,
            'user_id' => $this->userid,
        ]);

        $this->resetUI();
        $this->emit('proyecto-updated', 'Proyecto Actualizado');

    }

    public function resetUI()
    {
        $this->nombre = '';
        $this->prioridad = 'ELEGIR';
        $this->ingreso_estimado = '';
        $this->gasto_estimado = '';
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
        $this->clienteid = 'ELEGIR';
        $this->userid = 'ELEGIR';
        $this->search = '';
        $this->team = '';
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
