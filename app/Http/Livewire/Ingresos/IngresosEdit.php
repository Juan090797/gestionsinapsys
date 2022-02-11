<?php

namespace App\Http\Livewire\Ingresos;

use App\Http\Livewire\Ingresos\Traits\CalcularIngreso;
use App\Http\Livewire\Ingresos\Traits\DataIngreso;
use App\Models\CentroCosto;
use App\Models\Cliente;
use App\Models\Motivo;
use App\Models\MovimientoAlmacen;
use App\Models\MovimientoAlmacenDetalle;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class IngresosEdit extends Component
{
    use LivewireAlert;
    use CalcularIngreso;
    use DataIngreso;

    public $state = [];
    public $movimiento, $lista;

    public function mount($ingreso)
    {
        $this->movimiento = MovimientoAlmacen::with('movimientoDetalles')->find($ingreso);
        $this->state = $this->movimiento->toArray();
        $this->rows = $this->movimiento->movimientoDetalles->toArray();
        $this->cantidadTotal = $this->movimiento->total_items;
        $this->lista = collect();
    }
    public function render()
    {
        $this->update();
        return view('livewire.ingresos.ingresos-edit')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->productos();
        $this->motivos();
        $this->costos();
    }

    public function updatedStateMotivoId($value)
    {
        if($value == 6 || $value == 7){
            $this->lista = User::all();
        }else{
            $this->lista = Cliente::all();
        }
    }

    public function productos()
    {
        $this->productos = Producto::all();
    }
    public function motivos()
    {
        $this->motivos = Motivo::where('tipo', 'I')->get();
    }
    public function costos()
    {
        $this->costos = CentroCosto::all();
    }

    public function actualizarIngreso()
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
        //se busca el usuario o cliente
        $use = User::where('name', $this->state['usuario_id'])->get();
        $use = $use[0]->id;
        if (!$use){
            $use = Cliente::where('razon_social', $this->state['usuario_id'])->get();
            $use = $use[0]->ruc;
        }
        $nuevo =$this->movimiento;
        $nuevo->update([
            'fecha_documento'   => $this->state['fecha_documento'] ?? now(),
            'ruc_cliente'       => $use,
            'nombre_cliente'    => $this->state['usuario_id'],
            'total_items'       => $this->cantidadTotal,
            'estado'            => 'PENDIENTE',
            'motivo_id'         => $this->state['motivo_id'],
            'centro_costo_id'   => $this->state['centro_costo_id']
        ]);
        $nuevo->movimientoDetalles->each(function($item) {
            $item->delete();
        });

        collect($this->rows)->filter(function ($item) {
            return $item['producto_id'] !== '';
        })->each(function($item) use($nuevo) {
            MovimientoAlmacenDetalle::updateOrCreate(
                [
                    'id' => $item['id'] ?? MovimientoAlmacenDetalle::orderBy('id', 'desc')->first()->id + 1
                ],
                [
                    'movimiento_almacens_id'=> $nuevo->id,
                    'producto_id'           => $item['producto_id'],
                    'cantidad'              => $item['cantidad'],
                    'stock_old'             => $item['stock_old'] ?? 0,
                ]
            );
        });

        $this->alert('success', 'Se actualizo el registro con exito',['timerProgressBar' => true]);
        return redirect()->route('ingreso.show', $this->movimiento->id);
    }
}
