<?php

namespace App\Http\Livewire\Ordenes;

use App\Http\Livewire\Ordenes\Traits\CalcularOrden;
use App\Http\Livewire\Ordenes\Traits\DataOrden;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\MovimientoAlmacen;
use App\Models\OrdenCompra;
use App\Models\OrdenCompraDetalle;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateOrdenes extends Component
{
    use LivewireAlert;
    use CalcularOrden;
    use DataOrden;

    public $proveedores, $productos, $usuarios, $codigo;
    public $state =[];
    public $selectedProducts = [];

    Public function mount()
    {
        $this->state = [
            'terminos' => 'FACTURAR A: CORPORACION SINAPSYS SAC
RUC: 20606088630
DIRECCIÓN: CALLE BELGICA MZ. H LT. 8 URB. SAN ELIAS – LOS OLIVOS
ENTREGA: CALLE BELGICA MZ. H LT. 8 URB. SAN ELIAS – LOS OLIVOS
PLAZO DE ENTREGA:
FORMA DE PAGO: Adelantado
'
        ];
    }
    public function render()
    {
        $this->update();
        return view('livewire.ordenes.create-ordenes')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->proveedors();
        $this->products();
        $this->users();
    }

    public function proveedors()
    {
        $this->proveedores = Proveedor::all();
    }
    public function products()
    {
        $this->productos = Producto::all();
    }
    public function users()
    {
        $this->usuarios = User::all();
    }
    public function createOrden()
    {
        $validated = Validator::make($this->state, [
            'fecha_documento'   => 'required',
            'user_id'           => 'required',
            'proveedor_id'      => 'required',
            'terminos'          => 'required',
        ],[
            'fecha_documento.required'  => 'La fecha de documento es requerido',
            'user_id.required'       => 'El usuario es requerido',
            'proveedor_id.required'     => 'El proveedor es requerido',
            'terminos.required'  => 'Los terminos son requeridos',
        ])->validate();

        $i = 1;
        $this->dto($i);
        $validated['codigo'] = $this->codigo;
        $validated['estado'] = 'PENDIENTE';
        $validated['referencia'] = $this->state['referencia'] ?? null;
        $validated['subtotal'] = $this->subTotal;
        $validated['impuesto'] = $this->impuestoD;
        $validated['total'] = $this->total;
        $validated['total_items'] = $this->cantidadTotal;

        $orden = OrdenCompra::create($validated);

        foreach ($this->rows as $item)
        {
            OrdenCompraDetalle::create([
                'orden_compra_id'   => $orden->id,
                'producto_id'       => $item['producto_id'],
                'cantidad'          => $item['cantidad'],
                'precio_unitario'   => $item['precio'],
                'precio_total'      => $item['monto'],
            ]);
        }
        $this->resetUI();
        $this->alert('success', 'Se registro la orden compra',['timerProgressBar' => true]);
        return redirect()->route('ordenes');
    }

    public function dto($i)
    {
        if(OrdenCompra::count() > 0) {
            $i = OrdenCompra::latest()->first()->id +1;
        }
        $date= 'OC'.(Carbon::now())->format('ym');
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
    public function resetUI()
    {
        $this->selectedProducts =[];
        $this->selected_id = '';
        $this->resetValidation();
    }
}
