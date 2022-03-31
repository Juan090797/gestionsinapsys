<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Empresa;
use Livewire\Component;

class ShowCotizacion extends Component
{
    public $cotizacion, $cliente;
    public $state= [];

    public function mount(Cotizacion $cotizacion)
    {
        $this->cotizacion = $cotizacion;
        $this->state = $cotizacion->toArray();
        $this->cliente    = Cliente::findOrFail($this->cotizacion->cliente_id);
    }
    public function render()
    {
        $empresa = Empresa::all()->first();
        return view('livewire.cotizacion.show', ['empresa' => $empresa])->extends('layouts.tema.app')->section('content');
    }
}
