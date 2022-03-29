<?php

namespace App\Http\Livewire\Pedidos;

use App\Http\Livewire\Pedidos\Traits\CalcularPedido;
use App\Http\Livewire\Pedidos\Traits\DataPedido;
use App\Models\CentroCosto;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\TipoDocumento;
use Livewire\Component;

class PedidoCreate extends Component
{
    use CalcularPedido;
    use DataPedido;
    public $state = [];
    public $clientes,$documentos,$costos,$productos;

    public function render()
    {
        $this->update();
        return view('livewire.pedidos.pedido-create')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->clientes();
        $this->documentos();
        $this->costos();
        $this->productos();
    }
    public function clientes()
    {
        $this->clientes = Cliente::all();
    }
    public function documentos()
    {
        $this->documentos = TipoDocumento::where('tipo','pago')->get();
    }
    public function costos()
    {
        $this->costos = CentroCosto::all();
    }
    public function productos()
    {
        $this->productos = Producto::where('clasificacions_id','MERCADERIA')->get();
    }
}
