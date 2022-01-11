<?php

namespace App\Http\Livewire\Kardex;

use App\Http\Livewire\ComponenteBase;
use App\Models\MovimientoAlmacen;
use App\Models\MovimientoAlmacenDetalle;
use App\Models\Producto;

class KardexProducto extends ComponenteBase
{
    public $state = [];
    public $data = [];
    public $detalles = [];
    public $productos, $resultado,$fecha_inicio, $fecha_fin, $pro,$sumEntradas,$sumSalidas;

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

    public function consultar()
    {
        $a = 0;
        $suma1 = 0;
        $suma2 = 0;
        $this->fecha_inicio = $this->state['fecha_inicio'];
        $this->fecha_fin = $this->state['fecha_fin'];
        $this->pro= Producto::find($this->state['producto_id']);
        $this->data = MovimientoAlmacen::with('movimientoDetalles','motivos')
            ->whereHas('movimientoDetalles', function ($query) {
                $query->where('producto_id',$this->state['producto_id'] );
            })
            ->whereBetween('created_at', [$this->state['fecha_inicio'], $this->state['fecha_fin']])
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

    }

}
