<?php

namespace App\Http\Livewire\Ordenes;

use App\Http\Livewire\ComponenteBase;
use App\Models\OrdenCompra;

class ListaOrdenes extends ComponenteBase
{
    public $ordenes;

    public function render()
    {
        $this->update();
        return view('livewire.ordenes.lista-ordenes')->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->ordens();
    }

    public function ordens()
    {
        $this->ordenes = OrdenCompra::all();
    }
}
