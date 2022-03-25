<?php

namespace App\Exports;

use App\Models\Compra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ComprasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $sumaigv,$sumabase, $sumatotal;
    public function __construct()
    {
        $a = Compra::all();
        $this->sumaigv = $a->sum('impuesto');
        $this->sumabase = $a->sum('subtotal');
        $this->sumatotal = $a->sum('total');
    }

    public function view(): View
    {
        return view('livewire.compras.excel-compras', [
            'compras' => Compra::with('compraDetalles', 'costo', 'proveedor')->get(),
            'sumabase' => $this->sumabase,
            'sumaigv' => $this->sumaigv,
            'sumatotal' => $this->sumatotal,
        ]);
    }
}

