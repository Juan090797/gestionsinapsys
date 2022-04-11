<?php

namespace App\Http\Livewire\Pedidos;

use App\Http\Livewire\Pedidos\Traits\CalcularPedido;
use App\Http\Livewire\Pedidos\Traits\DataPedido;
use App\Models\Cliente;
use App\Models\CompraDetalle;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PedidoEdit extends Component
{
    use LivewireAlert;
    use DataPedido;
    use CalcularPedido;

    public $pedido,$clientes,$productos;
    public $state = [];

    public function mount(Pedido $pedido)
    {
        $this->pedido = $pedido;
        $this->state = $pedido->toArray();
        $this->lista = $pedido->pedidoDetalle->toArray();
        $this->cantidadTotal = $pedido->total_items;
        $this->subTotal = $pedido->subtotal;
        $this->impuestoD = $pedido->impuesto;
        $this->total = $pedido->total;
    }
    public function render()
    {
        $this->update();
        return view('livewire.pedidos.pedido-edit')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->clientes();
        $this->productos();
    }
    public function clientes()
    {
        $this->clientes = Cliente::all();
    }
    public function productos()
    {
        $this->productos = Producto::where('clasificacions_id',2)->get();
    }
    public function actualizarPedido()
    {
        $validated = Validator::make($this->state, [
            'cliente_id'        => 'required',
            'fecha_pedido'         => 'required',
            'atendido'          => 'required',
            'plazo_entrega'     => 'required',
            'txt_plazo'         => 'required',
            'garantia'          => 'required',
            'txt_garantia'      => 'required',
            'num_mantenimiento' => '',
            'txt_mantenimiento' => '',
            'direccion_entrega' => 'required',
        ],[
            'cliente_id.required'       => 'El cliente es requerido',
            'fecha_pedido.required'     => 'La fecha del pedido es requerido',
            'atendido.required'         => 'La persona atendida es requerida',
            'plazo_entrega.required'    => 'El plazo de entrega es requerido',
            'txt_plazo.required'        => 'El texto de plazo de entrega es requerido',
            'garantia.required'         => 'La garantia es requerida',
            'txt_garantia.required'     => 'La texto de la garantia es requerida',
            'direccion_entrega.required'=> 'La direccion de entrega es requerida',
        ])->validate();

        $creator = array_merge(
            $validated,
            [
                'estado'            => 'EN PROCESO',
                'user_id'           => Auth::id(),
                'subtotal'          => $this->subTotal,
                'total'             => $this->total,
                'impuesto'          => $this->impuestoD,
                'pedido_items'      => $this->lista,
                'total_items'       => $this->cantidadTotal,
            ]
        );
        DB::transaction(function() use($creator) {
            $this->pedido->update($creator);
            $p = $this->pedido;
            PedidoDetalle::where('pedido_id', $p->id)->delete();
            collect($creator['pedido_items'])->filter(function ($item) {
                return $item['producto_id'] !== '';
            })->each(function($item) use($p) {
                PedidoDetalle::create([
                    'pedido_id'     => $p->id,
                    'producto_id'   => $item['producto_id'],
                    'descripcion'   => $item['descripcion'],
                    'cantidad'      => $item['cantidad'],
                    'precio_u'      => $item['precio_u'],
                    'precio_t'      => $item['precio_t'],
                ]);
            });
        });
        $this->alert('success', 'Se actualizo el pedido con exito',['timerProgressBar' => true]);
        return redirect()->route('pedido.show',$this->pedido->id);
    }
}
