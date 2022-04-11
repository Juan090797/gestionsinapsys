<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Http\Livewire\Cotizaciones\Traits\CalcularCotizacion;
use App\Http\Livewire\Cotizaciones\Traits\DataCotizacion;
use App\Models\Cotizacion;
use App\Models\CotizacionItem;
use App\Models\impuesto;
use App\Models\Producto;
use App\Models\Proyecto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCotizacion extends Component
{
    use LivewireAlert;
    use DataCotizacion;
    use CalcularCotizacion;
    use WithFileUploads;

    public $proyecto;
    public $state = [];
    public $impuesto = null;
    public $code, $ct;
    public $productos, $impuestos, $global,$imagen,$nombreArchivo;

    public function mount(Proyecto $proyecto)
    {
        if(Cotizacion::count() > 0){
            $i = Cotizacion::latest()->first()->id +1;
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
            'terminos' => 'Forma de Pago: Credito Comercial
Remitir al O/C al correo electronico: ventas@gruposinapsys.pe
Numero de Cta. BBVA: 011-342-000100028409-39
Numero de Cta. BBVA (CCI): 011-342-000100028409-39
Numero de Cta. Detracciones (Bco. Nacion): 00-051-159853',
            'foto' => false,
            'cliente_id' => $this->proyecto->cliente_id,
        ];
    }

    public function render()
    {
        $this->update();
        return view('livewire.cotizacion.create')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->productos();
        $this->impuestos();
    }
    public function productos()
    {
        $this->productos = Producto::where('clasificacions_id',2)->get();
    }
    public function impuestos()
    {
        $this->impuestos = impuesto::all();
    }
    public function createCotizacion()
    {
        $validated = Validator::make($this->state, [
            'cliente_id'        => '',
            'impuesto_id'       => 'required',
            'foto'              => '',
            'fecha_fin'         => 'required',
            'fecha_inicio'      => 'required',
            'atendido'          => 'required',
            'terminos'          => 'required',
            'plazo_entrega'     => 'required',
            'txt_plazo'         => 'required',
            'garantia'          => 'required',
            'txt_garantia'      => 'required',
            'num_mantenimiento' => '',
            'txt_mantenimiento' => '',
            'direccion_entrega' => 'required',
        ],[
            'impuesto_id.required'      => 'El impuesto es requerido',
            'fecha_fin.required'        => 'La fecha de expiracion es requerida',
            'fecha_inicio.required'     => 'La fecha de inicio es requerida',
            'atendido.required'         => 'La persona atendida es requerida',
            'terminos.required'         => 'Los terminos son requeridos',
            'plazo_entrega.required'    => 'El plazo de entrega es requerido',
            'txt_plazo.required'        => 'El texto de plazo de entrega es requerido',
            'garantia.required'         => 'La garantia es requerida',
            'txt_garantia.required'     => 'La texto de la garantia es requerida',
            'direccion_entrega.required'=> 'La direccion de entrega es requerida',
        ])->validate();

        if ($this->imagen)
        {
            $this->nombreArchivo = $this->imagen->getClientOriginalName();
            $this->imagen->storeAs('cotizaciones', $this->nombreArchivo);
        }
        $creator = array_merge(
            $validated,
            [
                'subtotal'          => $this->subTotal,
                'total'             => $this->total,
                'impuesto'          => $this->impuestoD,
                'cotizacion_items'  => $this->lista,
                'codigo'            => $this->code,
                'total_items'       => $this->cantidadTotal,
                'archivo_cotizacion'=> $this->nombreArchivo,
            ]
        );
        DB::transaction(function() use ($creator) {
            $coti= $this->proyecto->Cotizaciones()->create($creator);
            $this->global = $coti;
            collect($creator['cotizacion_items'])->filter(function ($item) {
                return $item['producto_id'] !== '';
            })->each(function($item) use($coti) {
                CotizacionItem::create([
                    'cotizacion_id' => $coti->id,
                    'producto_id'   => $item['producto_id'],
                    'descripcion'   => $item['descripcion'],
                    'cantidad'      => $item['cantidad'],
                    'precio_u'      => $item['precio_u'],
                    'precio_t'      => $item['precio_t'],
                ]);
            });
        });
        $this->alert('success', 'Cotizacion creada!!',['timerProgressBar' => true]);
        return redirect()->route('cotizacion.show',$this->global->id);
    }
}
