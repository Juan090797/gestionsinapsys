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
        $this->documentos = TipoDocumento::all();
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
        $this->emit('tipo-added');
        $this->alert('success', 'Tipo documento Registrado',['timerProgressBar' => true]);
    }
}