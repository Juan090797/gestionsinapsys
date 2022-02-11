<?php

namespace App\Http\Livewire\Kardex;

use App\Http\Livewire\ComponenteBase;
use App\Models\MovimientoAlmacen;
use App\Models\MovimientoAlmacenDetalle;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;

class KardexProducto extends ComponenteBase
{
    public $state = [];
    public $data = [];
    public $detalles = [];
    public $productos, $resultado,$sumEntradas,$sumSalidas,$fecha_inicio, $fecha_fin, $pro;

    public function render()
    {
        $this->update();
        return view('livewire.kardex.kardex-producto')->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->productos();
    }

    public function productos()
    {
        $this->productos = Producto::all();
    }

    protected $rules = [
        'pro' => 'required',
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
    ];

    protected $messages = [
        'pro.required' => 'El producto es obligatorio',
        'fecha_inicio.required' => 'La fecha de inicio es obligatorio',
        'fecha_fin.required' => 'La fecha de fin es obligatorio',
    ];

    public function consultar()
    {
        $validated = Validator::make($this->state, [
            'producto_id' => 'required',
            'fecha_inicio'  => 'required',
            'fecha_fin' => 'required',
        ],[
            'producto_id.required' => 'El producto es requerido',
            'fecha_inicio.required' => 'La fecha de inicio es requerido',
            'fecha_fin.required' => 'La fecha de fin es requerido',
        ])->validate();

        $suma1 = 0;
        $suma2 = 0;
        $this->fecha_inicio = $this->state['fecha_inicio'];
        $this->fecha_fin = $this->state['fecha_fin'];
        $this->pro= Producto::find($this->state['producto_id']);
        $this->data = MovimientoAlmacen::with('movimientoDetalles','motivos')
            ->where('estado', 'APROBADO')
            ->whereHas('movimientoDetalles', function ($query) {
                $query->where('producto_id',$this->state['producto_id'] );
            })
            ->whereBetween('created_at', [$this->state['fecha_inicio'], $this->state['fecha_fin']])
            ->orderBy('updated_at', 'asc')
            ->get();
        foreach ($this->data as $r)
        {
            if ($r->tipo_documento == "GI"){
                foreach ($r->movimientoDetalles as $t)
                {
                    if($t->producto_id == $this->pro->id)
                    {
                        $suma1 = $suma1 + $t->cantidad;
                    }
                }
            }else
            {
                foreach ($r->movimientoDetalles as $t)
                {
                    if($t->producto_id == $this->pro->id)
                    {
                        $suma2 = $suma2 + $t->cantidad;
                    }
                }
            }
        }
        $this->sumEntradas = $suma1;
        $this->sumSalidas  = $suma2;

        $this->resetValidation();

    }

}
