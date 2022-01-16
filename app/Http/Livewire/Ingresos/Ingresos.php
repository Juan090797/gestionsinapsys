<?php

namespace App\Http\Livewire\Ingresos;

use App\Http\Livewire\ComponenteBase;
use App\Models\MovimientoAlmacen;
use App\Models\Producto;

class Ingresos extends ComponenteBase
{
    public $selectedProducts = [];
    public $search, $selected_id,$ped;
    public $state = [];

    public function  updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if(strlen($this->search) > 0) {
            $data = MovimientoAlmacen::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = MovimientoAlmacen::where('tipo_documento', 'GI')->orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.ingresos.index', ['ingresos' => $data])->extends('layouts.tema.app')->section('content');
    }

    public function AprobarMovimiento()
    {
        if(count($this->selectedProducts))
        {
            $p = MovimientoAlmacen::with('movimientoDetalles')->find($this->selectedProducts);
            foreach ($p[0]->movimientoDetalles as $item)
            {
                $prod = Producto::find($item->producto_id);
                $prod->update([
                    'stock' => $prod->stock + $item->cantidad,
                ]);
            }
            $p[0]->update([
                'estado' => 'Aprobado',
            ]);
            $this->resetUI();
            $this->emit('aprobado', 'Se aprobo el movimiento y se ajusto el stock');
        }else {
            $this->emit('error', 'Selecciona un Movimiento');
        }
    }

    public function resetUI()
    {
        $this->selectedProducts =[];
        $this->selected_id = '';
        $this->resetValidation();
    }

    public function verIngreso($id)
    {
        $this->ped = MovimientoAlmacen::with('movimientoDetalles')->find($id);
        $this->emit('show-modal-ingreso', 'Show modal');
    }
}
