<?php

namespace App\Http\Livewire\Compras;

use App\Http\Livewire\Compras\Traits\CalcularCompra;
use App\Http\Livewire\Compras\Traits\DataCompra;
use App\Models\CentroCosto;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\MovimientoAlmacen;
use App\Models\MovimientoAlmacenDetalle;
use App\Models\Producto;
use App\Models\Proveedor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateCompra extends Component
{
    use CalcularCompra;
    use DataCompra;
    public $state = [];

    public function render()
    {
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        $costos = CentroCosto::all();

        return view('livewire.compras.create-compra',
        [
            'productos' => $productos,
            'proveedores' => $proveedores,
            'costos' => $costos,
        ]
        )->extends('layouts.tema.app')->section('content');
    }

    public function createCompra()
    {
        $validated = Validator::make($this->state, [
            'tipo_documento' => 'required',
            'numero_documento' => 'required',
            'fecha_documento' => 'required',
            'fecha_pago' => 'required',
            'proveedor_id' => 'required',
            'centro_costo_id' => 'required',
        ],[
            'tipo_documento.required' => 'El tipo de documento es requerido',
            'numero_documento.required' => 'El numero de documento es requerido',
            'fecha_documento.required' => 'La fecha de documento es requerido',
            'fecha_pago.required' => 'La fecha de pago es requerido',
            'proveedor_id.required' => 'El proveedor es requerido',
            'centro_costo_id.required' => 'El centro de costo es requerido',

        ])->validate();

        $compra = Compra::create([
            'tipo_documento'            => $this->state['tipo_documento'],
            'numero_documento'     => $this->state['numero_documento'],
            'fecha_documento' => $this->state['fecha_documento'],
            'fecha_pago'        => $this->state['fecha_pago'],
            'subtotal'          => $this->subTotal,
            'impuesto'          => $this->impuestoD,
            'total'             => $this->total,
            'total_items'           => $this->cantidadTotal,
            'proveedor_id'      => $this->state['proveedor_id'],
            'centro_costo_id' => $this->state['centro_costo_id'],
        ]);

        foreach ($this->rows as $item)
        {
            CompraDetalle::create([
                'compra_id'     => $compra->id,
                'producto_id'   => $item['producto_id'],
                'cantidad'      => $item['cantidad'],
                'precio_u'      => $item['precio'],
                'precio_t'      => $item['monto'],
            ]);
            $producto = Producto::find($item['producto_id']);
            $producto->update([
                'precio_compra' => $item['monto'],
            ]);
        }

        //crea la guia de ingreso .. movimiento almacen
        if($compra){
            if(MovimientoAlmacen::count() > 0)
            {
                $i = MovimientoAlmacen::latest()->first()->id +1;
            }else
            {
                $i = 1;
            }
            $date = Carbon::now();
            $date2 = $date->Format('Y-m-d');
            $date = $date->Format('ym');
            if($i <= 9)
            {
                $this->codigo = 'GI'. $date .'0000'. $i;
            }elseif ($i <= 100)
            {
                $this->codigo = 'GI'. $date .'000'. $i;
            }elseif ($i <= 1000)
            {
                $this->codigo = 'GI'. $date .'00'. $i;
            }elseif ($i <= 10000)
            {
                $this->codigo = 'GI'. $date .'0'. $i;
            }else
            {
                $this->codigo = 'GI'. $date. $i;
            }

            $cli = Proveedor::find($this->state['proveedor_id']);
            $guia = MovimientoAlmacen::create([
                'tipo_documento'    => 'GI',
                'numero_guia'       =>  $this->codigo,
                'referencia'        => $compra->numero_documento,
                'ruc_cliente'       => $cli->ruc,
                'nombre_cliente'    => $cli->razon_social,
                'total_items'       => $compra->total_items,
                'estado'            => 'Pendiente',
                'motivo_id'         => 1,
                'fecha_ingreso'     => $date2,
            ]);

            foreach ($this->rows as $item)
            {
                MovimientoAlmacenDetalle::create([
                    'movimiento_almacens_id'    => $guia->id,
                    'producto_id'               => $item['producto_id'],
                    'cantidad'                  => $item['cantidad'],
                ]);
            }
        }

        $this->emit('compra-registrada', 'Compra Registrado');
        return redirect()->route('compras');
    }

}
