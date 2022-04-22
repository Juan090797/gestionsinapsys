<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Proyectos extends ComponenteBase
{
    use LivewireAlert;
    public $selected_id;
    public $state=[];
    public $clientes,$users,$proyectosAprobadosCount,$proyectosArchivadosCount,$proyectosCompletadosCount,$proyectosDefinidosCount,$proyectosCount;
    public $status = null;
    protected $queryString =['status'];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function  updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $this->update();
        $data = Proyecto::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('proyecto_users')
                        ->whereColumn('proyecto_users.proyecto_id', 'proyectos.id')
                        ->Where('proyecto_users.user_id',Auth::id());})
            ;})->when($this->status, function ($query, $status) {
                return $query->where('estado', $status);})
            ->paginate($this->pagination);
        return view('livewire.proyectos.index',['proyectos' => $data])->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->clients();
        $this->users();
        $this->proyectosCount();
        $this->proyectosDefinidosCount();
        $this->proyectosAprobadosCount();
        $this->proyectosArchivadosCount();
        $this->proyectosCompletadosCount();
    }
    public function clients()
    {
        $this->clientes = Cliente::all();
    }
    public function users()
    {
        $this->users = User::all();
    }
    public function filtroProyectosEstados($status = null)
    {
        $this->resetPage();
        $this->status = $status;
    }
    public function proyectosCount()
    {
        $this->proyectosCount = Proyecto::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('proyecto_users')
                        ->whereColumn('proyecto_users.proyecto_id', 'proyectos.id')
                        ->Where('proyecto_users.user_id',Auth::id());
                });
        })->count();
    }
    public function proyectosDefinidosCount()
    {
        $this->proyectosDefinidosCount = Proyecto::where('estado','DEFINIDO')->where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('proyecto_users')
                        ->whereColumn('proyecto_users.proyecto_id', 'proyectos.id')
                        ->Where('proyecto_users.user_id',Auth::id());
                });
        })->count();
    }
    public function proyectosAprobadosCount()
    {
        $this->proyectosAprobadosCount = Proyecto::where('estado','APROBADO')->where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('proyecto_users')
                        ->whereColumn('proyecto_users.proyecto_id', 'proyectos.id')
                        ->Where('proyecto_users.user_id',Auth::id());
                });
        })->count();
    }
    public function proyectosArchivadosCount()
    {
        $this->proyectosArchivadosCount = Proyecto::where('estado','ARCHIVADO')->where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('proyecto_users')
                        ->whereColumn('proyecto_users.proyecto_id', 'proyectos.id')
                        ->Where('proyecto_users.user_id',Auth::id());
                });
        })->count();
    }
    public function proyectosCompletadosCount()
    {
        $this->proyectosCompletadosCount = Proyecto::where('estado','COMPLETADO')->where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('proyecto_users')
                        ->whereColumn('proyecto_users.proyecto_id', 'proyectos.id')
                        ->Where('proyecto_users.user_id',Auth::id());
                });
        })->count();
    }
    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre'            => "required|min:3|unique:proyectos,nombre,{$this->selected_id}",
            'prioridad'         => 'required',
            'estado'            => 'required',
            'ingreso_estimado'  => 'required',
            'gasto_estimado'    => 'required',
            'fecha_inicio'      => 'required',
            'fecha_fin'         => 'required',
            'cliente_id'        => 'required',
            'user_id'           => 'required'
        ],[
            'nombre.required'           => 'Nombre del proyecto es requerido',
            'nombre.unique'             => 'Ya existe el nombre del proyecto',
            'nombre.min'                => 'El nombre del proyecto debe tener al menos 3 caracteres',
            'prioridad.required'        => 'La prioridad es requerida',
            'estado.required'           => 'El estado es requerido',
            'ingreso_estimado.required' => 'El ingreso estimado es requerido',
            'gasto_estimado.required'   => 'El gasto estimado es requerido',
            'fecha_inicio.required'     => 'La fecha inicio es requerido',
            'fecha_fin.required'        => 'La fecha expiracion es requerido',
        ])->validate();
        $validated['etapa_id'] = 1;
        Proyecto::create($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Proyecto creado!!',['timerProgressBar' => true]);
    }
    public function Edit(Proyecto $proyecto)
    {
        $this->selected_id  = $proyecto->id;
        $this->state        = $proyecto->toArray();
        $this->emit('show-modal');
    }
    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'nombre'            => "required|min:3|unique:proyectos,nombre,{$this->selected_id}",
            'prioridad'         => 'required',
            'estado'            => 'required',
            'ingreso_estimado'  => 'required',
            'gasto_estimado'    => 'required',
            'fecha_inicio'      => 'required',
            'fecha_fin'         => 'required',
            'cliente_id'        => 'required',
            'user_id'           => 'required'
        ],[
            'nombre.required'           => 'Nombre del proyecto es requerido',
            'nombre.unique'             => 'Ya existe el nombre del proyecto',
            'nombre.min'                => 'El nombre del proyecto debe tener al menos 3 caracteres',
            'prioridad.required'        => 'La prioridad es requerida',
            'estado.required'           => 'El estado es requerido',
            'ingreso_estimado.required' => 'El ingreso estimado es requerido',
            'gasto_estimado.required'   => 'El gasto estimado es requerido',
            'fecha_inicio.required'     => 'La fecha inicio es requerido',
            'fecha_fin.required'        => 'La fecha expiracion es requerido',
        ])->validate();

        $proyecto = Proyecto::findOrFail($this->state['id']);
        $proyecto->update($validated);
        $this->resetUI();
        $this->emit('hide-modal');
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
        $proyecto->update(['estado' => 'ARCHIVADO']);
        $this->resetUI();
        $this->alert('success', 'Proyecto archivado!!',['timerProgressBar' => true]);
    }
}
