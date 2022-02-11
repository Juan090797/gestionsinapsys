<?php

namespace App\Http\Livewire\Ingresos;

use App\Http\Livewire\ComponenteBase;
use App\Models\MovimientoAlmacen;
use App\Models\Producto;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Ingresos extends ComponenteBase
{
    use LivewireAlert;
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
            $p = MovimientoAlmacen::with('movimientoDetalles')->find($this->selectedProducts)->first();
            foreach ($p->movimientoDetalles as $item) {
                $prod = Producto::find($item->producto_id);
                if($prod->stock > 0){
                    $item->update([
                        'stock_old' => $prod->stock,
                    ]);
                }
                $prod->update([
                    'stock' => $prod->stock + $item->cantidad,
                ]);
            }
            $p->update([
                'fecha_documento' => now(),
                'estado' => 'APROBADO',
            ]);
            $this->resetUI();
            $this->alert('success', 'Se aprobo el movimiento y se ajusto el stock',['timerProgressBar' => true]);
        }else {
            $this->alert('error', 'Selecciona un registro',['timerProgressBar' => true]);
        }
    }

    public function resetUI()
    {
        $this->selectedProducts =[];
        $this->selected_id = '';
        $this->resetValidation();
    }

}
