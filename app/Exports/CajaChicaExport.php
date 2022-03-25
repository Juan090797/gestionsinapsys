<?php

namespace App\Exports;

use App\Models\Caja;
use App\Models\CajaMovimiento;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CajaChicaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $sumaIngresos, $sumaEgresos, $saldo;
    public function __construct(Caja $caja)
    {
        $this->caja = $caja;
        $this->sumaIngresos = CajaMovimiento::where(['caja_id' => $this->caja->id, 'tipo' => 'INGRESO', 'estado' => 'APROBADO'])->sum('importe');
        $this->sumaEgresos = CajaMovimiento::where(['caja_id' => $this->caja->id, 'tipo' => 'EGRESO', 'estado' => 'APROBADO'])->sum('importe');
        $this->saldo = $this->sumaIngresos - $this->sumaEgresos;
    }

    public function view(): View
    {
        return view('livewire.caja.excel-movimientos', [
            'movimientos'   => CajaMovimiento::where('caja_id', $this->caja->id)->with('cliente','usuario','caja')->get(),
            'sumaIngresos'  => $this->sumaIngresos,
            'sumaEgresos'   => $this->sumaEgresos,
            'saldo'         =>$this->saldo,
        ]);
    }
}

