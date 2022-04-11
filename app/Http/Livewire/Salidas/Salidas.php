<?php

namespace App\Http\Livewire\Salidas;

use App\Http\Livewire\ComponenteBase;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\MovimientoAlmacen;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Salidas extends ComponenteBase
{
    use LivewireAlert;
    public $selectedProducts = [];
    public $search, $selected_id;
    public $state = [];
    protected $listeners = ['deleteRow' => 'anular'];

    public function  updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if(strlen($this->search) > 3) {
            $data = MovimientoAlmacen::where('tipo_documento', 'GS')->where('nombre_cliente', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else {
            $data = MovimientoAlmacen::where('tipo_documento', 'GS')->orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.Salidas.index', ['salidas' => $data])->extends('layouts.tema.app')->section('content');
    }

    public function AprobarMovimiento()
    {
        if(count($this->selectedProducts))
        {
            $p = MovimientoAlmacen::with('movimientoDetalles')->find($this->selectedProducts)->first();
            foreach ($p->movimientoDetalles as $item)
            {
                $prod = Producto::find($item->producto_id);
                if($prod->stock > 0){
                    $item->update([
                        'stock_old' => $prod->stock,
                    ]);
                }
                $prod->update([
                    'stock' => $prod->stock - $item->cantidad,
                ]);
            }
            $p->update([
                'fecha_documento' => now(),
                'estado' => 'APROBADO',
            ]);
            $this->alert('success', 'Se aprobo el movimiento y se ajusto el stock',['timerProgressBar' => true]);
        }else {
            $this->alert('error', 'Selecciona un registro',['timerProgressBar' => true]);
        }
    }
    public function anular(MovimientoAlmacen $movimientoAlmacen)
    {
        DB::transaction(function() use ($movimientoAlmacen) {
            $movimientoAlmacen->update([
                'estado' => 'ANULADO'
            ]);
            foreach ($movimientoAlmacen->movimientoDetalles as $item) {
                $p = Producto::find($item['producto_id']);
                $item->update([
                    'stock' => $p->stock + $item['cantidad'],
                ]);
            }
        });
        $this->alert('success', 'Movimiento anulado y stock ajustado',['timerProgressBar' => true]);
    }
    public function resetUI()
    {
        $this->selectedProducts =[];
        $this->selected_id = '';
        $this->resetValidation();
    }
}
