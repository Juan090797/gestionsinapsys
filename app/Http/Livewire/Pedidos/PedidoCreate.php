<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\Cotizacion;
use Livewire\Component;

class PedidoCreate extends Component
{
    public $state = [];
    public $codigo, $cliente, $atendido, $terminos, $condiciones, $total, $subTotal,$impuestoD;

    public function GetCotizacion($idcotizacion)
    {
        $cotizacion1 = Cotizacion::with('CotizacionItem')->find($idcotizacion);
        $this->codigo= $cotizacion1->codigo;
        $this->cliente = $cotizacion1->cliente->razon_social;
        $this->atendido= $cotizacion1->atendido;
        $this->terminos= $cotizacion1->terminos;
        $this->condiciones= $cotizacion1->condiciones;
        $this->total= $cotizacion1->total;
        $this->subTotal= $cotizacion1->subtotal;
        $this->impuestoD= $cotizacion1->impuesto;
    }
    public function render()
    {
        $cotizaciones = Cotizacion::all();
        return view('livewire.pedidos.pedido-create',
            [
                'cotizaciones' => $cotizaciones
            ]
        )->extends('layouts.tema.app')->section('content');
    }
}
