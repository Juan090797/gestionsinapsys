<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Http\Livewire\Cotizaciones\Traits\CalcularCotizacion;
use App\Http\Livewire\Cotizaciones\Traits\DataCotizacion;
use App\Models\CotizacionItem;
use App\Models\impuesto;
use App\Models\Producto;
use App\Models\Cotizacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EditCotizacion extends Component
{
    use LivewireAlert;
    use DataCotizacion;
    use CalcularCotizacion;

    public $cotizacion;
    public $CotizacionItem;
    public $impuesto;
    public $state = [];
    public $code;
    public $productos, $impuestos,$imagen,$nombreArchivo;

    public function mount(Cotizacion $cotizacion)
    {
        $this->cotizacion = $cotizacion;
        $this->CotizacionItem = $cotizacion->CotizacionItem;
        $this->impuesto = impuesto::find($cotizacion->impuesto_id);
        $this->state = $cotizacion->toArray();
        $this->lista = $cotizacion->CotizacionItem->toArray();
        $this->total = $cotizacion->total;
        $this->subTotal = $cotizacion->subtotal;
        $this->impuestoD = $cotizacion->impuesto;
        $this->cantidadTotal = $cotizacion->total_items;
    }
    public function render()
    {
        $this->update();
        return view('livewire.cotizacion.edit-cotizacion')->extends('layouts.tema.app')->section('content');
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
    public function updateCotizacion()
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
        }else{
            $this->nombreArchivo = $this->cotizacion->archivo_cotizacion;
        }

        $updater = array_merge($validated, [
                'subtotal'          => $this->subTotal,
                'total'             => $this->total,
                'impuesto'          => $this->impuestoD,
                'cotizacion_items'  => $this->lista,
                'archivo_cotizacion'=> $this->nombreArchivo,
            ],
        );
        $old = $this->cotizacion;
        DB::transaction(function() use($old,$updater) {
            $old->update($updater);
            CotizacionItem::where('cotizacion_id', $old->id)->delete();
            collect($updater['cotizacion_items'])->filter(function ($item) {
                return $item['producto_id'] !== '';
            })->each(function($item) use($old) {
                CotizacionItem::create([
                    'cotizacion_id' => $old->id,
                    'producto_id'   => $item['producto_id'],
                    'descripcion'   => $item['descripcion'],
                    'cantidad'      => $item['cantidad'],
                    'precio_u'      => $item['precio_u'],
                    'precio_t'      => $item['precio_t'],
                ]);
            });
        });
        $this->alert('success', 'Cotizacion actualizada!!',['timerProgressBar' => true]);
        return redirect()->route('cotizacion.show',$this->cotizacion->id);
    }
}
