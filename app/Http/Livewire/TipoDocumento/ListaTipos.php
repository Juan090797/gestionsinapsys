<?php

namespace App\Http\Livewire\TipoDocumento;

use App\Models\TipoDocumento;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ListaTipos extends Component
{
    use LivewireAlert;
    public $selected_id;
    public $state = [];
    protected $listeners =['deleteRow' => 'borrar'];

    public function render()
    {
        $this->update();
        return view('livewire.tipo-documento.lista-tipos')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->documentos();
    }
    public function documentos()
    {
        $this->documentos = TipoDocumento::where('estado','ACTIVO')->get();
    }
    public function resetUI()
    {
        $this->state=[];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre'    => 'required|unique:centro_costos|min:3',
            'codigo'    => 'required',
            'estado'    => '',
            'tipo'      => 'required',
        ],[
            'nombre.required'   => 'El nombre del centro de costo es requerido',
            'nombre.unique'     => 'Ya existe el nombre del centro de costo',
            'nombre.min'        => 'El nombre del centro de costo debe tener al menos 3 caracteres',
            'codigo.required'   => 'El codigo es requerido',
            'tipo.required'     => 'El tipo es requerido',
        ])->validate();

        TipoDocumento::create($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Tipo documento Registrado',['timerProgressBar' => true]);
    }
    public function Edit(TipoDocumento $tipoDocumento)
    {
        $this->selected_id = $tipoDocumento->id;
        $this->state = $tipoDocumento->toArray();
        $this->emit('show-modal');
    }
    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'nombre'    => 'required|unique:centro_costos|min:3',
            'codigo'    => 'required',
            'estado'    => '',
            'tipo'      => 'required',
        ],[
            'nombre.required'   => 'El nombre del centro de costo es requerido',
            'nombre.unique'     => 'Ya existe el nombre del centro de costo',
            'nombre.min'        => 'El nombre del centro de costo debe tener al menos 3 caracteres',
            'codigo.required'   => 'El codigo es requerido',
            'tipo.required'     => 'El tipo es requerido',
        ])->validate();
        $tipo = TipoDocumento::findOrFail($this->state['id']);
        $tipo->update($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Tipo documento actualizado!!',['timerProgressBar' => true]);
    }
    public function borrar(TipoDocumento $tipoDocumento)
    {
        $tipoDocumento->update(['estado' => 'INACTIVO']);
        $this->alert('success', 'Tipo documento eliminado!!',['timerProgressBar' => true]);
    }
}
