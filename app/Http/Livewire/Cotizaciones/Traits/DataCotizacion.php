<?php

namespace App\Http\Livewire\Cotizaciones\Traits;

use App\Models\Producto;

trait DataCotizacion
{
    public $nuevo;
    public $lista = [];

    public function updatedNuevo($value)
    {
        $pro = Producto::select(['id','codigo','nombre','descripcion','precio_compra'])->find($value)->toarray();
        $this->lista[] = $this->add_cart_shop($pro);
        $this->calcularTotalItems();
    }

    public function add_cart_shop($pro)
    {
        $pro['cantidad']    = 1;
        $pro['precio_u']    = 0.00;
        $pro['precio_t']    = 0.00;
        $pro['producto_id'] = $pro['id'];
        return $pro;
    }

    public function deleteRow($index)
    {
        unset($this->lista[$index]);
        $this->calculateSubTotal();
        $this->calculateTaxAmount($this->state['impuesto_id'] ?? null);
        $this->calculateTotal();
        $this->calcularTotalItems();
    }
}
