<?php

namespace App\Http\Livewire\Ordenes;

use App\Models\Empresa;
use App\Models\OrdenCompra;
use Livewire\Component;

class ShowOrdenes extends Component
{
    public $ordencompra;

    public function mount(OrdenCompra $orden)
    {
        $this->ordencompra = $orden;
    }
    public function render()
    {
        $empresa = Empresa::all()->first();
        return view('livewire.ordenes.show-ordenes',['empresa'=>$empresa])->extends('layouts.tema.app')->section('content');
    }
}
