<?php

namespace App\Http\Livewire\Kardex;

use App\Models\MovimientoAlmacen;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class KardexGeneral extends Component
{
    public $state = [];
    public $data = [];
    public $productos, $resultado,$sumEntradas,$sumSalidas,$fecha_inicio, $fecha_fin, $pro;
    public function render()
    {
        return view('livewire.kardex.kardex-general')->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {

    }
    protected $rules = [
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
    ];

    protected $messages = [
        'fecha_inicio.required' => 'La fecha de inicio es obligatorio',
        'fecha_fin.required' => 'La fecha de fin es obligatorio',
    ];

    public function consultar()
    {
        $validated = Validator::make($this->state, [
            'fecha_inicio'  => 'required',
            'fecha_fin' => 'required',
        ],[
            'fecha_inicio.required' => 'La fecha de inicio es requerido',
            'fecha_fin.required' => 'La fecha de fin es requerido',
        ])->validate();

        $suma1 = 0;
        $suma2 = 0;
        $this->fecha_inicio = $this->state['fecha_inicio'];
        $this->fecha_fin = $this->state['fecha_fin'];
        $this->data = MovimientoAlmacen::with('movimientoDetalles','motivos')
            ->where('estado', 'APROBADO')
            ->whereBetween('created_at', [$this->fecha_inicio, $this->fecha_fin])
            ->orderBy('updated_at', 'asc')
            ->get();
        foreach ($this->data as $r)
        {
            if ($r->tipo_documento == "GI"){
                foreach ($r->movimientoDetalles->groupBy('producto_id') as $t)
                {
                    $suma1 = $suma1 + $t->cantidad;
                }
            }else
            {
                foreach ($r->movimientoDetalles as $t)
                {
                    $suma2 = $suma2 + $t->cantidad;
                }
            }
        }
        $this->sumEntradas = $suma1;
        $this->sumSalidas  = $suma2;

        $this->resetValidation();

    }

}
