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
    public $selected_id, $ordencompra,$fechaplazo,$guia,$numeroPedido,$cliente,$total,$fechaemision,$numerofactura,$factura,$ped;
    public $pedidos;
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
        $this->ordencompra = '';
        $this->guia = '';
        $this->fechaplazo = '';
        $this->cliente = '';
        $this->numeroPedido = '';
        $this->total = '';
        $this->fechaemision = '';
        $this->numerofactura = '';
        $this->factura = '';
        $this->resetValidation();
    }

    public function AbrirOrdenCompra()
    {
        if(count($this->selectedProducts))
        {
            $this->selected_id = 1;
            $pedido = Pedido::find($this->selectedProducts);
            $pedido = $pedido[0];
            $this->numeroPedido = $pedido->codigo;
            if(is_null($pedido->ordencompra))
            {
                $this->emit('show-modal-oc', 'show-modal!');
            }else{
                $this->alert('error', 'El pedido ya tiene OC',['timerProgressBar' => true]);
            }
        }else {
            $this->alert('error', 'Selecciona un registro',['timerProgressBar' => true]);
        }
    }
    public function AgregarOrdenCompra()
    {
        $rules = [
            'ordencompra' => 'required',
            'fechaplazo'  => 'required',
        ];
        $messages =[
            'ordencompra.required' => 'La orden de compra es requerida',
            'fechaplazo.required' => 'La orden de compra es requerida',
        ];
        $this->validate($rules, $messages);

        $pedido = Pedido::find($this->selectedProducts);
        $pedido = $pedido[0];

        $name = $this->ordencompra->getClientOriginalName();
        $this->ordencompra->storeAs('ordenescompras', $name);
        $pedido->update([
            'ordencompra' => $name,
            'fecha_entrega'  => $this->fechaplazo,
        ]);
        $this->resetUI();
        $this->emit('oc-added', 'Orden de compra agregada');
    }
    public function descargaOc(Pedido $pedido)
    {
        $ocdesc = $pedido->ordencompra;
        return Storage::disk('local')->download('ordenescompras/'.$ocdesc);
    }

    public function AbrirGuia()
    {
        if(count($this->selectedProducts))
        {
            $this->selected_id = 1;
            $pedido = Pedido::find($this->selectedProducts);
            $pedido = $pedido[0];
            $this->numeroPedido = $pedido->codigo;
            if(is_null($pedido->guiaremision))
            {
                $this->emit('show-modal-guia', 'show-modal!');
            }else{
                $this->emit('error', 'El pedido ya tiene Guia');
            }

        }else{
            $this->alert('error', 'Selecciona un registro',['timerProgressBar' => true]);
        }
    }
    public function AgregarGuia()
    {
        $rules = [
            'guia' => 'required',
        ];
        $messages =[
            'guia.required' => 'La guia es requerida',
        ];
        $this->validate($rules, $messages);

        $pedido = Pedido::find($this->selectedProducts);
        $pedido = $pedido[0];
        $name = $this->guia->getClientOriginalName();
        $this->guia->storeAs('guiasremision', $name);
        $pedido->update([
            'guiaremision' => $name,
        ]);
        $this->resetUI();
        $this->emit('guia-added', 'Guia agregada');
    }
    public function descargaGuia(Pedido $pedido)
    {
        $guiadesc = $pedido->guiaremision;
        return Storage::disk('local')->download('guiasremision/'.$guiadesc);
    }

    public function AbrirFactura()
    {
        if(count($this->selectedProducts))
        {
            $p= Pedido::find($this->selectedProducts);
            if($p[0]->estado == 'Despachado')
            {
                $this->selected_id = 1;
                $pedido= Pedido::find($this->selectedProducts);
                $this->numeroPedido= $pedido[0]->codigo;
                $this->cliente= $pedido[0]->cliente->razon_social;
                $this->total= $pedido[0]->total;
                $this->emit('show-modal-factura', 'show-modal!');
            }else{
                $this->alert('error', 'El pedido tiene que despacharse primero',['timerProgressBar' => true]);
            }
        }else{
            $this->alert('error', 'Selecciona un registro',['timerProgressBar' => true]);
        }
    }
    public function AgregarFactura()
    {
        $rules = [
            'factura'       => 'required',
            'fechaemision'  => 'required',
            'numerofactura' => 'required',
        ];
        $messages =[
            'factura.required'      => 'El archivo es requerida',
            'fechaemision.required' => 'La fecha de emision es requerida',
            'numerofactura.required'=> 'El numero de factura es requerida',
        ];
        $this->validate($rules, $messages);
        $pedido = Pedido::find($this->selectedProducts)->first();
        $name = $this->factura->getClientOriginalName();
        $this->factura->storeAs('facturas', $name);
        $pedido->update([
            'factura_archivo'   => $name,
            'fecha_emision'     => $this->fechaemision,
            'numero_factura'    => $this->numerofactura,
            'estado'            => 'FACTURADO',
        ]);

        $this->resetUI();
        $this->emit('factura-added', 'Facturacion exitosa!');
    }
    public function descargaFactura(Pedido $pedido)
    {
        $facturadesc = $pedido->factura_archivo;
        return Storage::disk('local')->download('facturas/'.$facturadesc);
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
