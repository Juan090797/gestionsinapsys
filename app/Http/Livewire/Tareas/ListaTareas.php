<?php

namespace App\Http\Livewire\Tareas;

use App\Models\Incidencia;
use App\Models\Instalacion;
use App\Models\Mantenimiento;
use Livewire\Component;

class ListaTareas extends Component
{
    public $incidencias,$mantenimientos,$selected_id,$instalaciones;

    public function render()
    {
        $this->update();
        return view('livewire.tareas.lista-tareas')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->mantenimientos();
        $this->incidencias();
        $this->instalaciones();
    }
    public function mantenimientos()
    {
        $this->mantenimientos = Mantenimiento::where('estado','!=','ANULADO')->where('estado','!=','TERMINADO')->get();
    }
    public function incidencias()
    {
        $this->incidencias = Incidencia::where('estado','!=','ANULADO')->where('estado','!=','SOLUCIONADO')->get();
    }
    public function instalaciones()
    {
        $this->instalaciones = Instalacion::where('estado','ASIGNADO')->orWhere('estado','EN PROCESO')->get();
    }
    public function editarIncidencia(Incidencia $incidencia)
    {
        $this->selected_id  = $incidencia->id;
        $this->state        = $incidencia->toArray();
        $this->emit('show-modal-incidencia');
    }
}
