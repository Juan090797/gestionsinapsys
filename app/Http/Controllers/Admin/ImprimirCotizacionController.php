<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ImprimirCotizacionController extends Controller
{
    public function __invoke(Cotizacion $cotizacion)
    {
        $empresa = Empresa::all()->first();
        $number = $cotizacion->id;
        $cliente = Cliente::findOrFail($cotizacion->cliente_id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('livewire.cotizacion.vista', compact('cotizacion', 'cliente', 'empresa'));

        return $pdf->download('cotizacion_'. $number .'.pdf' );
    }
}
