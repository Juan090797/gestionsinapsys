<?php

namespace App\Http\Livewire\Pedidos;

use App\Http\Livewire\Pedidos\Traits\CalcularPedido;
use App\Http\Livewire\Pedidos\Traits\DataPedido;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Producto;
use App\Models\TipoDocumento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PedidoCreate extends Component
{
    use LivewireAlert;
    use CalcularPedido;
    use DataPedido;
    public $state = [];
    public $clientes,$documentos,$costos,$productos,$code,$pedidoNew;

    public function render()
    {
        $this->update();
        return view('livewire.pedidos.pedido-create')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->clientes();
        $this->documentos();
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
    public function productos()
    {
        $this->productos = Producto::where('clasificacions_id',2)->get();
    }
    public function createPedido()
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
                'codigo'            => $this->code,
                'total_items'       => $this->cantidadTotal,
            ]
        );
        if(Pedido::count() > 0){
            $i = Pedido::latest()->first()->id +1;
        }else{
            $i = 1;
        }
        $date = Carbon::now();
        $date = $date->Format('ym');
        if($i <= 9){
            $this->code = 'PE'. $date .'0000'. $i;
        }elseif ($i <= 100){
            $this->code = 'PE'. $date .'000'. $i;
        }elseif ($i <= 1000){
            $this->code = 'PE'. $date .'00'. $i;
        }elseif ($i <= 10000){
            $this->code = 'PE'. $date .'0'. $i;
        }else{
            $this->code = 'PE'. $date. $i;
        }
        DB::transaction(function() use($creator) {
            $pedido = Pedido::create([
                'codigo'            => $this->code,
                'estado'            => $creator['estado'],
                'atendido'          => $creator['atendido'],
                'fecha_pedido'      => $creator['fecha_pedido'],
                'plazo_entrega'     => $creator['plazo_entrega'],
                'txt_plazo'         => $creator['txt_plazo'],
                'garantia'          => $creator['garantia'],
                'txt_garantia'      => $creator['txt_garantia'],
                'num_mantenimiento' => $creator['num_mantenimiento'],
                'txt_mantenimiento' => $creator['txt_mantenimiento'],
                'direccion_entrega' => $creator['direccion_entrega'],
                'cliente_id'        => $creator['cliente_id'],
                'subtotal'          => $creator['subtotal'],
                'total'             => $creator['total'],
                'total_items'       => $creator['total_items'],
                'impuesto'          => $creator['impuesto'],
                'user_id'           => Auth::id(),
            ]);
            $this->pedidoNew = $pedido;
            foreach ($creator['pedido_items'] as $item){
                PedidoDetalle::create([
                    'pedido_id'     => $pedido->id,
                    'producto_id'   => $item['producto_id'],
                    'descripcion'   => $item['descripcion'],
                    'cantidad'      => $item['cantidad'],
                    'precio_u'      => $item['precio_u'],
                    'precio_t'      => $item['precio_t'],
                ]);
            }
        });
        $this->alert('success', 'Pedido creado!!',['timerProgressBar' => true]);
        return redirect()->route('pedido.show',$this->pedidoNew->id);
    }
}
