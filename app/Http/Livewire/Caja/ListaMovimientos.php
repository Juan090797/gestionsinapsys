<?php

namespace App\Http\Livewire\Caja;

use App\Exports\CajaChicaExport;
use App\Exports\ProductosExport;
use App\Models\Caja;
use App\Models\CajaMovimiento;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ListaMovimientos extends Component
{
    use LivewireAlert;
    public $state = [];
    public $selectedProducts =[];
    public $search, $selected_id;
    public $movimientos, $users, $clientes, $caja, $sumaIngresos, $sumaEgresos, $saldo;
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function mount(Caja $caja)
    {
        $this->caja = $caja;
    }
    public function render()
    {
        $this->update();
        return view('livewire.caja.lista-movimientos')->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->movimientos();
        $this->users();
        $this->clientes();
        $this->sumaIngresos();
        $this->sumaEgresos();
        $this->saldo();
    }

    public function movimientos()
    {
        $this->movimientos = CajaMovimiento::all();
    }
    public function users()
    {
        $this->users = User::all();
    }
    public function clientes()
    {
        $this->clientes = Cliente::all();
    }
    public function sumaIngresos()
    {
        $this->sumaIngresos = CajaMovimiento::where(['caja_id' => $this->caja->id, 'tipo' => 'INGRESO', 'estado' => 'APROBADO'])->sum('importe');
    }

    public function sumaEgresos()
    {
        $this->sumaEgresos = CajaMovimiento::where(['caja_id' => $this->caja->id, 'tipo' => 'EGRESO', 'estado' => 'APROBADO'])->sum('importe');
    }
    public function saldo()
    {
        $this->saldo = $this->sumaIngresos - $this->sumaEgresos;
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
            'tipo'      => 'required',
            'user_id'   => 'required',
            'fecha'     => 'required',
            'referencia'=> '',
            'cliente_id'=> '',
            'concepto'  => 'required',
            'motivo'    => 'required',
            'importe'   => 'required',
            'detalle'   => '',
        ],[
            'tipo.required'     => 'El tipo de movimiento es requerido',
            'user_id.required'  => 'El usuario es requerido',
            'fecha.required'    => 'La fecha de movimiento es requerido',
            'concepto.required' => 'El concepto es requerido',
            'motivo.required'   => 'El motivo es requerido',
            'importe.required'  => 'El importe es requerido',
        ])->validate();

        $validated['estado'] = 'PENDIENTE';

        $this->caja->movimientos()->create($validated);
        $this->resetUI();
        $this->emit('movimiento-added');
        $this->alert('success', 'Caja registrada',['timerProgressBar' => true]);
    }

    public function Edit(CajaMovimiento $cajaMovimiento)
    {
        $this->selected_id = $cajaMovimiento->id;
        $this->state = $cajaMovimiento->toArray();
        $this->emit('show-modal', 'show-modal!');
    }

    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'tipo'      => 'required',
            'user_id'   => 'required',
            'fecha'     => 'required',
            'referencia'=> '',
            'cliente_id'=> '',
            'concepto'  => 'required',
            'motivo'    => 'required',
            'importe'   => 'required',
            'detalle'   => '',
        ],[
            'tipo.required'     => 'El tipo de movimiento es requerido',
            'user_id.required'  => 'El usuario es requerido',
            'fecha.required'    => 'La fecha de movimiento es requerido',
            'concepto.required' => 'El concepto es requerido',
            'motivo.required'   => 'El motivo es requerido',
            'importe.required'  => 'El importe es requerido',
        ])->validate();

        $cajamov = CajaMovimiento::findOrFail($this->state['id']);
        $cajamov->update($validated);
        $this->resetUI();
        $this->emit('movimiento-updated');
        $this->alert('success', 'Movimiento actualizado',['timerProgressBar' => true]);
    }

    public function Destroy(CajaMovimiento $cajaMovimiento)
    {
        DB::transaction(function() use($cajaMovimiento){
            if($cajaMovimiento->estado == 'APROBADO')
            {
                if($cajaMovimiento->tipo == 'INGRESO')
                {
                    $cajaMovimiento->caja()->decrement('saldo',$cajaMovimiento->importe);
                }else{
                    $cajaMovimiento->caja()->increment('saldo',$cajaMovimiento->importe);
                }
            }
            $cajaMovimiento->delete();
        });
        $this->resetUI();
        $this->alert('success', 'Se elimino la compra con exito',['timerProgressBar' => true]);

    }
    public function aprobar()
    {
        if(count($this->selectedProducts))
        {
            $cajaMovimiento = CajaMovimiento::find($this->selectedProducts)->first();
            if($cajaMovimiento->tipo == 'INGRESO'){
                $cajaMovimiento->caja->increment('saldo',$cajaMovimiento->importe);
            }else{
                $cajaMovimiento->caja->decrement('saldo',$cajaMovimiento->importe);
            }
            $cajaMovimiento->update([
                'estado' => 'APROBADO'
            ]);
            $this->resetUI();
            $this->alert('success', 'Se aprobo movimiento con exito',['timerProgressBar' => true]);
        }else {
            $this->resetUI();
            $this->alert('error', 'Selecciona un movimiento',['timerProgressBar' => true]);
        }
    }
    public function exportMovimientos(Caja $caja)
    {
        $reportName = 'Movimientos_' . uniqid() . '.xlsx';
        return Excel::download(new CajaChicaExport($caja), $reportName);
    }
}
