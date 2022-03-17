<?php

namespace App\Http\Livewire\Requerimientos;

use Livewire\Component;

class ListaRequerimientos extends Component
{
    public function render()
    {
        return view('livewire.requerimientos.lista-requerimientos')->extends('layouts.tema.app')->section('content');
    }
}
