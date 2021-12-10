<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\Pedido;
use Livewire\Component;

class Pedidos extends Component
{
    public function render()
    {
        $pedidos = Pedido::with('pedidoDetalle')->latest()->get();
        return view('livewire.pedidos.index', ['pedidos' => $pedidos])->extends('layouts.tema.app')->section('content');
    }
}
