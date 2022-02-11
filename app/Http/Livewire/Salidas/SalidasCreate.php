<?php

namespace App\Http\Livewire\Salidas;

use App\Http\Livewire\ComponenteBase;
use App\Http\Livewire\Salidas\Traits\CalcularSalida;
use App\Http\Livewire\Salidas\Traits\DataSalida;
use App\Models\CentroCosto;
use App\Models\Cliente;
use App\Models\Motivo;
use App\Models\MovimientoAlmacen;
use App\Models\MovimientoAlmacenDetalle;
use App\Models\Producto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SalidasCreate extends ComponenteBase
{
    use LivewireAlert;
    use CalcularSalida;
    use DataSalida;
    public $state = [];
    public $lista;

    public function mount()
    {
        $this->lista = collect();
    }

    public function render()
    {
        $productos = Producto::where('stock', '>', 0)->get();
        $motivos = Motivo::where('tipo', 'S')->get();
        $costos = CentroCosto::all();
        return view('livewire.salidas.salidas-create',[
            'productos' => $productos,
            'motivos' => $motivos,
            'costos' => $costos
        ])->extends('layouts.tema.app')->section('content');
    }

    public function updatedStateMotivoId($value)
    {
        if($value == 3 || $value == 5){
            $this->lista = User::all();
        }else{
            $this->lista = Cliente::all();
        }
    }

    public function createSalida()
    {
        $validated = Validator::make($this->state, [
            'usuario_id' => 'required',
            'motivo_id'  => 'required',
            'centro_costo_id' => 'required',
        ],[
            'usuario_id.required' => 'El usuario o cliente es requerido',
            'motivo_id.required' => 'El motivo es requerido',
            'centro_costo_id.required' => 'El centro de costo es requerido',
        ])->validate();

        $id_movimiento =[];
        foreach ($this->rows as  $item) {
            $product = Producto::where('id' , $item['producto_id'])->first();
            if ($product->stock >= $item['cantidad'] ){
                $id_movimiento[] = $this->add_cart_shop($item);
            }else{
                //mensaje no hay stock del producto .......
                $this->alert('error', 'Lo sentimos no tenemos  stock',['timerProgressBar' => true]);
            }
        }

        if( count($this->rows) == count($id_movimiento) )
        {
            $i = MovimientoAlmacen::count() > 0 ? MovimientoAlmacen::latest()->first()->id +1 : 1;
            $date = Carbon::now();
            $date = $date->Format('ym');
            if($i <= 9) {
                $this->codigo = 'GS'. $date .'0000'. $i;
            }elseif ($i <= 100) {
                $this->codigo = 'GS'. $date .'000'. $i;
            }elseif ($i <= 1000) {
                $this->codigo = 'GS'. $date .'00'. $i;
            }elseif ($i <= 10000) {
                $this->codigo = 'GS'. $date .'0'. $i;
            }else {
                $this->codigo = 'GS'. $date. $i;
            }
            //se busca el usuario o cliente
            $use = User::where('name', $this->state['usuario_id'])->get();
            $use = $use[0]->id;
            if (!$use){
                $use = Cliente::where('razon_social', $this->state['usuario_id'])->get();
                $use = $use[0]->ruc;
            }
            ////crea el movimiento almacen
            $guia = MovimientoAlmacen::create([
                'tipo_documento'    => 'GS',
                'numero_guia'       => $this->codigo,
                'fecha_documento'   => $this->state['fecha_documento']?? now(),
                'referencia'        => $this->state['referencia']?? '',
                'ruc_cliente'       => $use,
                'nombre_cliente'    => $this->state['usuario_id'],
                'total_items'       => $this->cantidadTotal,
                'estado'            => 'PENDIENTE',
                'motivo_id'         => $this->state['motivo_id'],
                'centro_costo_id'   => $this->state['centro_costo_id']
            ]);
            foreach ($this->rows as  $item) {
                MovimientoAlmacenDetalle::create([
                    'movimiento_almacens_id'    => $guia->id,
                    'producto_id'               => $item['producto_id'],
                    'cantidad'                  => $item['cantidad'],
                ]);
            }
            $this->alert('success', 'Se creo el registro',['timerProgressBar' => true]);
            return redirect()->route('salida.show', $guia->id);
        }
    }

    public function add_cart_shop($item)
    {
        return $item;
    }
}
