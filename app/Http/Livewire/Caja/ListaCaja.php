<?php

namespace App\Http\Livewire\Caja;

use App\Exports\CajaChicaExport;
use App\Http\Livewire\ComponenteBase;
use App\Models\Caja;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Maatwebsite\Excel\Facades\Excel;

class ListaCaja extends ComponenteBase
{
    use LivewireAlert;
    public $cajas, $usuarios;
    public $search, $selected_id;
    public $state=[];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function render()
    {
        $this->update();
        return view('livewire.caja.lista-caja')->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->cajas();
        $this->usuarios();
    }

    public function cajas()
    {
        $this->cajas = Caja::with('user')->get();
    }
    public function usuarios()
    {
        $this->usuarios = User::all();
    }

    public function resetUI()
    {
        $this->selectedProducts =[];
        $this->selected_id = '';
        $this->resetValidation();
    }

    public function Store()
    {
        $validated = Validator::make($this->state, [
            'nombre'    => 'required',
            'saldo'     => '',
            'user_id'=> 'required',
        ],[
            'nombre.required'  => 'El nombre es requerido',
            'user_id.required' => 'El usuario es requerido',
        ])->validate();

        Caja::create($validated);
        $this->resetUI();
        $this->emit('movimiento-added');
        $this->alert('success', 'Caja registrada',['timerProgressBar' => true]);
    }

    public function Edit(Caja $caja)
    {
        $this->selected_id = $caja->id;
        $this->state = $caja->toArray();
        $this->emit('show-modal', 'show-modal!');
    }

    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'nombre'    => 'required',
            'saldo'     => '',
            'user_id'=> 'required',
        ],[
            'nombre.required'  => 'El nombre es requerido',
            'user_id.required' => 'El usuario es requerido',
        ])->validate();

        $caja = Caja::find($this->state['id']);
        $caja->update($validated);
        $this->resetUI();
        $this->emit('movimiento-updated');
        $this->alert('success', 'Caja actualizada',['timerProgressBar' => true]);
    }

    public function Destroy(Caja $caja)
    {
        $caja->delete();
        $this->resetUI();
        $this->alert('success', 'Caja eliminada',['timerProgressBar' => true]);
    }

    public function exportCaja()
    {
        $reportName = 'Cajas' . uniqid() . '.xlsx';
        return Excel::download(new CajaChicaExporT, $reportName);
    }
}
