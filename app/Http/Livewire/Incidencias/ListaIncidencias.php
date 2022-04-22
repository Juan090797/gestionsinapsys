<?php

namespace App\Http\Livewire\Incidencias;

use App\Models\Cliente;
use App\Models\Contacto;
use App\Models\Incidencia;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ListaIncidencias extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $state = [];
    public $incidencias,$clientes,$selected_id;
    public $contactos,$productos,$tecnicos,$reporte;

    public function mount()
    {
        $this->contactos = collect();
        $this->state = ['if_visita' => false];
    }
    public function render()
    {
        $this->update();
        return view('livewire.incidencias.lista-incidencias')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->incidencias();
        $this->clientes();
        $this->productos();
        $this->tecnicos();
    }
    public function incidencias()
    {
        $this->incidencias = Incidencia::all();
    }
    public function clientes()
    {
        $this->clientes = Cliente::where('estado','ACTIVO')->get();
    }
    public function productos()
    {
        $this->productos = Producto::where(['estado' => 'ACTIVO','clasificacions_id' => 2])->get();
    }
    public function updatedStateClienteId($value)
    {
        $this->contactos = Contacto::where('cliente_id',$value)->get();
    }
    public function tecnicos()
    {
        $this->tecnicos = User::where('perfil','Soporte')->get();
    }
    public function resetUI()
    {
        $this->state=[];
        $this->selected_id = 0;
        $this->reporte = null;
        $this->resetValidation();
    }
    public function Store()
    {
        $validated = Validator::make($this->state, [
            'cliente_id'            => 'required',
            'contacto_id'           => 'required',
            'producto_id'           => 'required',
            'canal_comunicacion'    => 'required',
            'txt_incidencia'        => 'required',
            'prioridad'             => 'required',
            'if_visita'             => 'required',
            'fecha_aviso'           => 'required',
            'user_id'               => 'required',
            'fecha_ejecucion'       => 'required',
            'estado'                => 'required',
            'fecha_cierre'          => '',
            'notas'                 => '',
        ],[
            'cliente_id.required'           => 'El cliente es requerido',
            'contacto_id.required'          => 'El contacto es requerido',
            'producto_id.required'          => 'EL producto es requerido',
            'canal_comunicacion.required'   => 'El canal de comunicacion es requerido',
            'txt_incidencia.required'       => 'El detalle de la incidencia es requerido',
            'prioridad.required'            => 'La prioridad es requerida',
            'if_visita.required'            => 'Si necesita o no vista es requerido',
            'fecha_aviso.required'          => 'La fecha de aviso es requerido',
            'user_id.required'              => 'El tecnico es requerido',
            'fecha_ejecucion.required'      => 'La fecha de ejecucion es requerido',
            'estado.required'               => 'El estado es requerido',
        ])->validate();

        if ($this->reporte)
        {
            $this->nombreArchivo = $this->reporte->getClientOriginalName();
            $this->reporte->storeAs('incidencias', $this->nombreArchivo);
        }
        $creator = array_merge($validated, ['reporte' => $this->nombreArchivo]);
        Incidencia::create($creator);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Incidencia registrada!!',['timerProgressBar' => true]);
    }
    public function Edit(Incidencia $incidencia)
    {
        $this->selected_id = $incidencia->id;
        $this->state = $incidencia->toArray();
        $this->emit('show-modal');
    }
    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'cliente_id'            => 'required',
            'contacto_id'           => 'required',
            'producto_id'           => 'required',
            'canal_comunicacion'    => 'required',
            'txt_incidencia'        => 'required',
            'prioridad'             => 'required',
            'if_visita'             => 'required',
            'fecha_aviso'           => 'required',
            'user_id'               => 'required',
            'fecha_ejecucion'       => 'required',
            'estado'                => 'required',
            'fecha_cierre'          => '',
            'notas'                 => '',
        ],[
            'cliente_id.required'           => 'El cliente es requerido',
            'contacto_id.required'          => 'El contacto es requerido',
            'producto_id.required'          => 'EL producto es requerido',
            'canal_comunicacion.required'   => 'El canal de comunicacion es requerido',
            'txt_incidencia.required'       => 'El detalle de la incidencia es requerido',
            'prioridad.required'            => 'La prioridad es requerida',
            'if_visita.required'            => 'Si necesita o no vista es requerido',
            'fecha_aviso.required'          => 'La fecha de aviso es requerido',
            'user_id.required'              => 'El tecnico es requerido',
            'fecha_ejecucion.required'      => 'La fecha de ejecucion es requerido',
            'estado.required'               => 'El estado es requerido',
        ])->validate();

        $incidencia = Incidencia::findOrFail($this->state['id']);
        if ($this->reporte)
        {
            $this->nombreArchivo = $this->reporte->getClientOriginalName();
            $this->reporte->storeAs('incidencias', $this->nombreArchivo);
        }else{
            $this->nombreArchivo = $incidencia->reporte;
        }
        $updater = array_merge($validated, ['reporte' => $this->nombreArchivo]);
        $incidencia->update($updater);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Incidencia actualizada!!',['timerProgressBar' => true]);
    }
}
