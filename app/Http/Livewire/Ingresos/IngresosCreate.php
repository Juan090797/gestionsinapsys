<?php

namespace App\Http\Livewire\Ingresos;

use App\Http\Livewire\ComponenteBase;
use App\Http\Livewire\Ingresos\Traits\CalcularIngreso;
use App\Http\Livewire\Ingresos\Traits\DataIngreso;
use App\Models\CentroCosto;
use App\Models\Cliente;
use App\Models\Motivo;
use App\Models\MovimientoAlmacen;
use App\Models\MovimientoAlmacenDetalle;
use App\Models\Producto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class IngresosCreate extends ComponenteBase
{
    use LivewireAlert;
    use DataIngreso;
    use CalcularIngreso;
    public $state = [];
    public $productos, $motivos, $lista, $costos;

    public function mount()
    {
        $this->lista = collect();
    }

    public function render()
    {
        $this->update();
        return view('livewire.ingresos.ingresos-create')->extends('layouts.tema.app')->section('content');
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

    public function createIngreso()
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

        $i = MovimientoAlmacen::count() > 0 ? MovimientoAlmacen::latest()->first()->id +1 : 1;
        $date = Carbon::now();
        $date2 = $date->Format('Y-m-d');
        $date = $date->Format('ym');
        if($i <= 9) {
            $this->codigo = 'GI'. $date .'0000'. $i;
        }elseif ($i <= 100) {
            $this->codigo = 'GI'. $date .'000'. $i;
        }elseif ($i <= 1000) {
            $this->codigo = 'GI'. $date .'00'. $i;
        }elseif ($i <= 10000) {
            $this->codigo = 'GI'. $date .'0'. $i;
        }else {
            $this->codigo = 'GI'. $date. $i;
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
            'tipo_documento'    => 'GI',
            'numero_guia'       => $this->codigo,
            'fecha_documento'   => $this->state['fecha_documento']?? $date2,
            'referencia'        => $this->state['referencia']?? '',
            'ruc_cliente'       => $use,
            'nombre_cliente'    => $this->state['usuario_id'],
            'total_items'       => $this->cantidadTotal,
            'estado'            => 'APROBADO',
            'motivo_id'         => $this->state['motivo_id'],
            'centro_costo_id'   => $this->state['centro_costo_id']
        ]);

        foreach ($this->rows as  $item) {
            $producto = Producto::find($item['producto_id']);
            MovimientoAlmacenDetalle::create([
                'movimiento_almacens_id'    => $guia->id,
                'producto_id'               => $item['producto_id'],
                'cantidad'                  => $item['cantidad'],
                'stock_old' => $producto->stock,
            ]);
            $producto->update([
                'stock'     => $producto->stock + $item['cantidad'],
            ]);
        }
        $this->alert('success', 'Se creo el registro con exito',['timerProgressBar' => true]);
        return redirect()->route('ingreso.show', $guia->id);

    }

}
