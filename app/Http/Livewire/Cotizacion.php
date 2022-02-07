<?php

namespace App\Http\Livewire;

use App\Contracts\Admin\Cotizaciones\CreatesCotizaciones;
use App\Http\Livewire\Cotizaciones\Traits\CalcularCotizacion;
use App\Http\Livewire\Cotizaciones\Traits\DataCotizacion;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\impuesto;
use App\Models\Producto;
use App\Models\Proyecto;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Cotizacion extends Component
{
    use DataCotizacion;
    use CalcularCotizacion;
    use WithFileUploads;

    public $proyecto;
    public $state = [];
    public $billedTo = [];
    public $impuesto = null;
    public $code, $ct ;

    public function mount(Proyecto $proyecto)
    {
        if(\App\Models\Cotizacion::count() > 0){
            $i = \App\Models\Cotizacion::latest()->first()->id +1;
        }else{
            $i = 1;
        }
        $date = Carbon::now();
        $date = $date->Format('ym');
        if($i <= 9){
            $this->code = 'CT'. $date .'0000'. $i;
        }elseif ($i <= 100){
            $this->code = 'CT'. $date .'000'. $i;
        }elseif ($i <= 1000){
            $this->code = 'CT'. $date .'00'. $i;
        }elseif ($i <= 10000){
            $this->code = 'CT'. $date .'0'. $i;
        }else{
            $this->code = 'CT'. $date. $i;
        }
        $this->proyecto = $proyecto;
        $this->state = [
            'condiciones' => 'Plazo de entrega: 10 dias a partir de la recepcion de la O/C
Lugar de entrega: En su almacen de la entidad Jr. Cangallo N° 418 - Lima
Garantia: 6 meses contra todo defecto de fabrica',
            'terminos' => 'Forma de Pago: Credito Comercial
Remitir al O/C al correo electronico: ventas@gruposinapsys.pe
Numero de Cta. BBVA (CCI): 011-342-000100028409-39
Numero de Cta. Detracciones (Bco. Nacion): 00-051-159853',
            'proyecto_id' => $this->proyecto->id,
            'foto' => false,
            'cliente_id' => $this->proyecto->cliente_id,
        ];
    }

    public function createInvoice(CreatesCotizaciones $creator)
    {
        $ide = $this->state['proyecto_id'];
        $creator->create(array_merge(
            $this->state,
            [
                'subtotal' => $this->subTotal,
                'total' => $this->total,
                'impuesto' => $this->impuestoD,
                'cotizacion_items' => $this->rows,
                'codigo' => $this->code,
                'total_items' => $this->cantidadTotal,
            ]
        ));
        $this->emit('cotizacion-ok', 'Cotizacion creado con Exito');
        return redirect()->route('proyecto.show', $ide);
    }

    public function render()
    {
        $empresa = Empresa::all()->first();
        return view('livewire.cotizacion.create',
            [
                'cliente'  => Cliente::where('id', $this->proyecto->cliente_id)->get(),
                'productos' => Producto::all(),
                'impuestos' => impuesto::all(),
                'empresa'   => $empresa,
            ]
            )->extends('layouts.tema.app')->section('content');
    }


}
