<?php

namespace App\Http\Livewire\Ingresos;

use App\Models\Empresa;
use App\Models\MovimientoAlmacen;
use Livewire\Component;

class IngresosShow extends Component
{
    public $guia;
    public $state= [];

    public function mount($ingreso)
    {
        $this->guia = MovimientoAlmacen::with('movimientoDetalles')->find($ingreso);
    }
    public function render()
    {
        $empresa = Empresa::all()->first();
        return view('livewire.ingresos.ingresos-show', ['empresa' => $empresa])->extends('layouts.tema.app')->section('content');
    }
}
