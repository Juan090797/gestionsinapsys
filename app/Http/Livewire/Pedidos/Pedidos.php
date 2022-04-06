<?php

namespace App\Http\Livewire\Pedidos;

use App\Models\Cliente;
use App\Models\MovimientoAlmacen;
use App\Models\MovimientoAlmacenDetalle;
use App\Models\Pedido;
use App\Models\Producto;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Pedidos extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $selectedProducts = [];
    public $state= [];
    public $selected_id,$ped;
    public $pedidos;
    public $clientes;
    protected $listeners = ['anular' => 'Anular'];

    public function render()
    {
        $this->update();
        return view('livewire.pedidos.index')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->pedidos = Pedido::with('pedidoDetalle')->latest()->get();
    }
    public function resetUI()
    {
        $this->selectedProducts =[];
        $this->selected_id = '';
        $this->resetValidation();
    }

    public function Anular(Pedido $pedido){
        $pedido->update([
            'estado' => 'Anulado',
        ]);
        $this->resetUI();
        $this->emit('pedido-anulado', 'Pedido Anulado');
    }
    public function verPedido($id)
    {
        $this->ped = Pedido::with('pedidoDetalle')->find($id);
        $this->emit('show-modal-pedido', 'Show modal');
    }
    public function Despachar()
    {
        if(count($this->selectedProducts)) {
            $pedido = Pedido::with('pedidoDetalle')->find($this->selectedProducts[0]);
            $id_movimiento =[];
            foreach ($pedido->pedidoDetalle as $item)
            {
                $pr = Producto::find($item['producto_id']);
                if($pr->stock >= $item['cantidad']) {
                    $id_movimiento[] = $this->add_cart_shop($item);
                }else {
                    $this->alert('error', 'Lo sentimos no tenemos  stock',['timerProgressBar' => true]);
                }
            }
            if( count($pedido->pedidoDetalle) == count($id_movimiento) )
            {
                $i = MovimientoAlmacen::count() > 0 ? MovimientoAlmacen::latest()->first()->id +1 : 1;
                $date = Carbon::now();
                $date = $date->Format('ym');
                if($i <= 9){
                    $this->codigo = 'GS'. $date .'0000'. $i;
                }elseif ($i <= 100){
                    $this->codigo = 'GS'. $date .'000'. $i;
                }elseif ($i <= 1000){
                    $this->codigo = 'GS'. $date .'00'. $i;
                }elseif ($i <= 10000){
                    $this->codigo = 'GS'. $date .'0'. $i;
                }else{
                    $this->codigo = 'GS'. $date. $i;
                }

                $cli = Cliente::find($pedido->cliente_id);
                $guia = MovimientoAlmacen::create([
                    'tipo_documento'    => 'GS',
                    'numero_guia'       => $this->codigo,
                    'fecha_documento'     => now(),
                    'referencia'        => $pedido->codigo,
                    'ruc_cliente'       => $cli->ruc,
                    'nombre_cliente'    => $cli->razon_social,
                    'total_items'       => $pedido->total_items,
                    'estado'            => 'APROBADO',
                    'motivo_id'         => 2,
                    'centro_costo_id'   => 5,
                ]);
                foreach ($pedido->pedidoDetalle as $it)
                {
                    $producto = Producto::find($it['producto_id']);
                    MovimientoAlmacenDetalle::create([
                        'movimiento_almacens_id'    => $guia->id,
                        'producto_id'               => $it['producto_id'],
                        'stock_old'                 => $producto->stock,
                        'cantidad'                  => $it['cantidad'],
                    ]);
                    $producto->update([
                        'stock' => $producto->stock - $it['cantidad'],
                    ]);
                }
                $pedido->update([
                    'estado' => 'DESPACHADO',
                ]);
                $this->resetUI();
                $this->alert('success', 'Se despacho el pedido y se ajusto el stock',['timerProgressBar' => true]);
            }
        }else {
            $this->alert('error', 'Selecciona un registro',['timerProgressBar' => true]);
        }

    }
    public function add_cart_shop($item)
    {
        return $item;
    }
}
