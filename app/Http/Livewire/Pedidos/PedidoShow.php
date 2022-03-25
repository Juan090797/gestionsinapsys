<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\Pedido;
use Livewire\Component;

class PedidoShow extends Component
{
    public $pedido;

    public function mount(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }
    public function render()
    {
        return view('livewire.pedidos.pedido-show')->extends('layouts.tema.app')->section('content');
    }
}
