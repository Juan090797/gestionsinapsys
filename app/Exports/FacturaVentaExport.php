<?php

namespace App\Exports;

use App\Models\Compra;
use App\Models\FacturaVenta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FacturaVentaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $sumaigv,$sumabase, $sumatotal;
    public function __construct()
    {
        $a = FacturaVenta::all();
        $this->sumaigv = $a->sum('igv');
        $this->sumabase = $a->sum('subtotal');
        $this->sumatotal = $a->sum('total');
    }

    public function view(): View
    {
        return view('livewire.pedidos.facturas.factura-excel', [
            'facturas' => FacturaVenta::with('pedido', 'documento')->get(),
            'sumabase' => $this->sumabase,
            'sumaigv' => $this->sumaigv,
            'sumatotal' => $this->sumatotal,
        ]);
    }
}
