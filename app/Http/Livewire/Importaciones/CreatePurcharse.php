<?php

namespace App\Http\Livewire\Importaciones;

use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Http\Livewire\Importaciones\Traits\CalcularPurcharse;
use App\Http\Livewire\Importaciones\Traits\DataPurcharse;

class CreatePurcharse extends Component
{
    use LivewireAlert;
    use CalcularPurcharse;
    use DataPurcharse;

    public $productos,$proveedores,$codigo;
    public $state = [];

    public function mount()
    {
        $this->state = [
            'terminos' => '1. Please send two copies of your invoice.
2. Enter this order in accordance with the prices, terms, delivery
method, and specifications listed above.
3. Please notify us immediately if you are unable to ship as
specified.'
        ];
    }
    public function render()
    {
        $this->update();
        return view('livewire.importaciones.create-purcharse')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->productos();
        $this->proveedores();
    }
    public function productos()
    {
        $this->productos = Producto::where('estado','ACTIVO')->get();
    }
    public function proveedores()
    {
        $this->proveedores = Proveedor::all();
    }
    public function crearPurcharse()
    {
        $this->codigo();
        $validated = Validator::make($this->state, [
            'proveedor_id'  => 'required',
            'atendido'      => 'required',
            'foto'          => '',
            'fecha'         => 'required',
            'incoterm'      => 'required',
            'terminos'      => '',
        ],[
            'proveedor_id.required' => 'El proveedor es requerido',
            'fecha.required'        => 'La fecha es requerida',
            'atendido.required'     => 'La persona atendida es requerida',
            'incoterm.required'     => 'El incoterm es requerido',
        ])->validate();

        $creator = array_merge(
            $validated,
            [
                'subtotal'          => $this->subTotal,
                'salestax'          => $this->impuestoD,
                'handling'          => $this->handling,
                'otros'             => $this->otros,
                'total'             => $this->total,
                'codigo'            => $this->codigo,
                'user_id'           => 2,
                'purcharse_items'   => $this->lista,
            ]
        );
        DB::transaction(function() use ($creator) {
            $purchase = Purchase::create($creator);
            collect($creator['purcharse_items'])->filter(function ($item) {
                return $item['producto_id'] !== '';
            })->each(function($item) use($purchase) {
                PurchaseDetail::create([
                    'purchase_id'  => $purchase->id,
                    'producto_id'   => $item['producto_id'],
                    'descripcion'   => $item['descripcion'],
                    'cantidad'      => $item['cantidad'],
                    'precio_u'      => $item['precio_u'],
                    'precio_t'      => $item['precio_t'],
                ]);
            });
        });
        $this->alert('success', 'Purchase Order creada!!',['timerProgressBar' => true]);
        return redirect()->route('purchases');
    }
    public function codigo()
    {
        if(Purchase::count() > 0){
            $i = Purchase::latest()->first()->id +1;
        }else{
            $i = 1;
        }
        $this->codigo = Carbon::now()->format('ym') .'00'.$i;
    }
}
