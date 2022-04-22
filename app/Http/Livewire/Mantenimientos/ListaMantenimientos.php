<?php

namespace App\Http\Livewire\Mantenimientos;

use App\Models\Garantia;
use App\Models\Mantenimiento;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ListaMantenimientos extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $garantia,$mantenimientos,$selected_id,$tecnicos,$nombreArchivo;
    public $reporte;
    public $state = [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function mount(Garantia $garantia)
    {
        $this->garantia = $garantia;
    }
    public function render()
    {
        $this->update();
        return view('livewire.mantenimientos.lista-mantenimientos');
    }
    public function update()
    {
        $this->mantenimientos();
        $this->tecnicos();
    }
    public function mantenimientos()
    {
        $this->mantenimientos = Mantenimiento::where('garantia_id',$this->garantia->id)->get();
    }
    public function tecnicos()
    {
        $this->tecnicos = User::where('perfil','Soporte')->get();
    }
    public function resetUI()
    {
        $this->state=[];
        $this->selected_id = 0;
        $this->resetValidation();
        $this->reporte = null;
    }
    public function Store()
    {
        $validated = Validator::make($this->state, [
            'user_id'           => 'required',
            'estado'            => 'required',
            'fecha_ejecucion'   => 'required',
        ],[
            'user_id.required'          => 'El tecnico es requerido',
            'estado.required'           => 'El estado es requerido',
            'fecha_ejecucion.required'  => 'La fecha de ejecucion es requerido',
        ])->validate();
        if ($this->reporte)
        {
            $this->nombreArchivo = $this->reporte->getClientOriginalName();
            $this->reporte->storeAs('mantenimientos', $this->nombreArchivo);
        }
        $creator = array_merge($validated, ['reporte' => $this->nombreArchivo]);
        $this->garantia->mantenimientos()->create($creator);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Mantenimiento registrado!!',['timerProgressBar' => true]);
    }
    public function Edit(Mantenimiento $mantenimiento)
    {
        $this->selected_id = $mantenimiento->id;
        $this->state = $mantenimiento->toArray();
        $this->emit('show-modal');
    }
    public function actualizar()
    {
        $validated = Validator::make($this->state, [
            'user_id'           => 'required',
            'estado'            => 'required',
            'fecha_ejecucion'   => 'required',
        ],[
            'user_id.required'          => 'El tecnico es requerido',
            'estado.required'           => 'El estado es requerido',
            'fecha_ejecucion.required'  => 'La fecha de ejecucion es requerido',
        ])->validate();
        $mantenimiento = Mantenimiento::findOrFail($this->state['id']);
        if ($this->reporte)
        {
            $this->nombreArchivo = $this->reporte->getClientOriginalName();
            $this->reporte->storeAs('mantenimientos', $this->nombreArchivo);
        }else{
            $this->nombreArchivo = $mantenimiento->reporte;
        }
        $updater = array_merge($validated, ['reporte' => $this->nombreArchivo]);
        $mantenimiento->update($updater);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Mantenimiento actualizado!!',['timerProgressBar' => true]);
    }
    public function Destroy(Mantenimiento $mantenimiento)
    {
        $mantenimiento->update(['estado' => 'ANULADO']);
        $this->resetUI();
        $this->alert('success', 'Mantenimiento anulado',['timerProgressBar' => true]);
    }
}
