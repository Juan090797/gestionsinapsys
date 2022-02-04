<?php

namespace App\Http\Livewire\Salidas;

use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Empresa;
use App\Models\MovimientoAlmacen;
use Livewire\Component;

class SalidasShow extends Component
{
    public $guia;
    public $state= [];

    public function mount($salida)
    {
        $this->guia = MovimientoAlmacen::with('movimientoDetalles')->find($salida);
    }
    public function render()
    {
        $empresa = Empresa::all()->first();
        return view('livewire.salidas.salidas-show', ['empresa' => $empresa])->extends('layouts.tema.app')->section('content');
    }
}
