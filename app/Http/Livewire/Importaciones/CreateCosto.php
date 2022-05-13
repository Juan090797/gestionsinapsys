<?php

namespace App\Http\Livewire\Importaciones;

use App\Models\Aereo;
use App\Models\Costo;
use App\Models\Maritimo;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Purchase;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateCosto extends Component
{
    use LivewireAlert;
    public $orden,$productos,$proveedores;
    public $state = [];

    public function mount(Purchase $purchase)
    {
        $this->orden = $purchase;
    }

    public function render()
    {
        $this->update();
        return view('livewire.importaciones.create-costo')->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->productos();
        $this->proveedores();
    }
    public function productos()
    {
        $this->productos = Producto::where('estado', 'ACTIVO')->get();
    }
    public function proveedores()
    {
        $this->proveedores = Proveedor::where('estado','ACTIVO')->get();
    }
    public function crearCosteo()
    {
        $creator = array_merge($this->state, ['purchase_id' => $this->orden->id]);
        if($creator['tipo_costeo'] == 'MARITIMO')
        {
            $maritimo = Maritimo::create($creator);
            $maritimo->costo()->create($creator);
            $this->alert('success', 'Costeo maritimo registrado!!',['timerProgressBar' => true]);

        }elseif($creator['tipo_costeo'] == 'AEREO'){
            $aereo = Aereo::create($creator);
            $aereo->costo()->create($creator);
            $this->alert('success', 'Costeo areo registrado!!',['timerProgressBar' => true]);
        }

    }
}
