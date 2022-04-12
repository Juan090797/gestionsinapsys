<?php

namespace App\Http\Livewire\Ordenes;

use App\Http\Livewire\ComponenteBase;
use App\Models\OrdenCompra;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ListaOrdenes extends ComponenteBase
{
    use LivewireAlert;
    public $selectedProducts = [];
    public $ordenes,$ordenesCount,$ordenesPendienteCount,$ordenesAnuladoCount,$ordenesAprobadoCount;
    public $status = null;
    protected $queryString =['status'];
    protected $listeners =['deleteRow' => 'anular'];

    public function render()
    {
        $this->update();
        return view('livewire.ordenes.lista-ordenes')->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->ordens();
        $this->ordenesCount();
        $this->ordenesPendienteCount();
        $this->ordenesAprobadoCount();
        $this->ordenesAnuladoCount();
    }

    public function ordens()
    {
        $this->ordenes = OrdenCompra::when($this->status, function ($query, $status) {
            return $query->where('estado', $status);})->get();
    }
    public function filtroProyectosEstados($status = null)
    {
        $this->status = $status;
    }
    public function ordenesCount()
    {
        $this->ordenesCount = OrdenCompra::count();
    }
    public function ordenesPendienteCount()
    {
        $this->ordenesPendienteCount = OrdenCompra::where('estado','PENDIENTE')->count();
    }
    public function ordenesAprobadoCount()
    {
        $this->ordenesAprobadoCount = OrdenCompra::where('estado','APROBADO')->count();
    }
    public function ordenesAnuladoCount()
    {
        $this->ordenesAnuladoCount = OrdenCompra::where('estado','ANULADO')->count();
    }
    public function resetUI()
    {
        $this->selectedProducts =[];
        $this->selected_id = '';
        $this->resetValidation();
    }
    public function aprobar()
    {
        if(count($this->selectedProducts)) {
            $pedido = OrdenCompra::find($this->selectedProducts[0]);
            $pedido->update([
                'estado' => 'APROBADO',
            ]);
            $this->resetUI();
            $this->alert('success', 'Se aprobo orden de compra',['timerProgressBar' => true]);
        }else{
            $this->alert('error', 'Selecciona un registro',['timerProgressBar' => true]);
        }
    }
    public function anular(OrdenCompra $ordenCompra)
    {
        $ordenCompra->update(['estado' => 'ANULADO']);
        $this->alert('success', 'Se anulo orden de compra',['timerProgressBar' => true]);
    }
}
