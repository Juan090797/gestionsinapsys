<?php

namespace App\Http\Livewire\Compras;

use App\Exports\ComprasExport;
use App\Http\Livewire\ComponenteBase;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\MovimientoAlmacen;
use App\Models\MovimientoAlmacenDetalle;
use App\Models\Producto;
use App\Models\Proveedor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Maatwebsite\Excel\Facades\Excel;

class Compras extends ComponenteBase
{
    use LivewireAlert;
    public $selectedProducts = [];
    public $state= [];
    public $search, $selected_id;

    protected $listeners = ['deleteRow' => 'delete'];

    public function  updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        if(strlen($this->search) > 3) {
            $data = Compra::where('razon_social', 'like', '%' . $this->search . '%')
                ->paginate($this->pagination);
        }else {
            $data = Compra::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.compras.index', ['compras'=> $data])->extends('layouts.tema.app')->section('content');
    }

    public function AprobarMovimiento()
    {
        if(count($this->selectedProducts))
        {
            $compra = Compra::with('compraDetalles')->find($this->selectedProducts)->first();
            //crea el movimiento de almacen, si esque se crea la compra
            if($compra->estado == 'PENDIENTE'){
                $i = 1;
                $this->dto($i);
                $cli = Proveedor::find($compra->proveedor_id);
                $this->crearMovimiento($cli,$compra);
                $compra->update(['estado'=>'APROBADO']);
            }else{
                $this->resetUI();
                $this->alert('error', 'El registro ya esta aprobado',['timerProgressBar' => true]);
            }
            $this->resetUI();
            $this->alert('success', 'Se aprobo compra con exito',['timerProgressBar' => true]);
        }else {
            $this->alert('error', 'Selecciona un registro',['timerProgressBar' => true]);
        }
    }

    public function dto($i)
    {
        if(MovimientoAlmacen::count() > 0) {
            $i = MovimientoAlmacen::latest()->first()->id +1;
        }
        $date= 'GI'.(Carbon::now())->format('ym');
        switch ($i) {
            case ($i <= 9):
                $this->codigo = $date.'0000'.$i;
                break;
            case ($i <= 100):
                $this->codigo = $date.'000'.$i;
                break;
            case ($i <= 1000):
                $this->codigo = $date.'00'.$i;
                break;
            case ($i <= 10000):
                $this->codigo = $date.'0'.$i;
                break;
        }
    }

    public function crearMovimiento($cli,$compra)
    {
        $guia = MovimientoAlmacen::create([
            'tipo_documento'    => 'GI',
            'numero_guia'       => $this->codigo,
            'referencia'        => $compra->numero_documento,
            'total'             => $compra->total,
            'total_items'       => $compra->total_items,
            'fecha_documento'   => now(),
            'ruc_cliente'       => $compra->proveedor_id,
            'nombre_cliente'    => $cli->razon_social,
            'estado'            => 'PENDIENTE',
            'motivo_id'         => 1,
            'centro_costo_id'   => $compra->centro_costo_id,
        ]);
        foreach ($compra->compraDetalles as $item)
        {
            MovimientoAlmacenDetalle::create([
                'movimiento_almacens_id'    => $guia->id,
                'producto_id'               => $item['producto_id'],
                'cantidad'                  => $item['cantidad'],
            ]);
            $producto = Producto::find($item['producto_id']); //se busca el producto
            $producto->update([
                'precio_compra' => $item['precio_u'] ?? 0.00, //se actualiza el precio de compra  ultima.
            ]);
        }
    }

    public function resetUI()
    {
        $this->selectedProducts =[];
        $this->selected_id = '';
        $this->resetValidation();
    }

    public function exportCompras()
    {
        $reportName = 'Compras_' . uniqid() . '.xlsx';
        return Excel::download(new ComprasExport, $reportName);
    }

    public function delete(Compra $compra)
    {
        DB::transaction(function() use ($compra) {
            $compra->update([
                'estado' => 'ANULADO'
            ]);
        });
        $this->resetUI();
        $this->alert('success', 'Compra anulado',['timerProgressBar' => true]);
    }
}
