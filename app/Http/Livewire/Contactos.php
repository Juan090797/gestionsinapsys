<?php

namespace App\Http\Livewire;

use App\Models\Contacto;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Contactos extends Component
{
    use LivewireAlert;
    public $nombre, $celular_cont, $correo_cont, $area_cont, $cargo_cont, $estado_cont, $selected_id, $cliente_id, $clientem,$contactos;

    public function mount($cliente)
    {
        $this->cliente_id = $cliente->id;
        $this->selected_id = 0;
    }
    public function render()
    {
        $this->update();
        return view('livewire.contactos.contactos');
    }
    public function update()
    {
        $this->contactos();
    }
    public function contactos()
    {
        $this->contactos = Contacto::where('cliente_id',$this->cliente_id)->get();
    }
    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:contactos|min:3',
            'correo_cont' => 'required|unique:contactos',
            'celular_cont' => 'required',
            'area_cont' => 'required',
            'cargo_cont' => 'required',
            'estado_cont' => 'required',
        ];
        $messages =[
            'nombre.required' => 'Nombre del contacto es requerido',
            'nombre.unique' => 'Ya existe el nombre del contacto',
            'nombre.min' => 'El nombre del contacto debe tener al menos 3 caracteres',
        ];

        $this->validate($rules, $messages);
        $contacto = Contacto::create([
            'nombre' => $this->nombre,
            'celular_cont' => $this->celular_cont,
            'cod_estado' => $this->estado_cont,
            'cliente_id' => $this->cliente_id,
            'cargo_cont' => $this->cargo_cont,
            'area_cont' => $this->area_cont,
            'correo_cont' => $this->correo_cont,
        ]);

        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Contacto registrado!!',['timerProgressBar' => true]);
    }

    public function Edit($id)
    {
        $record = Contacto::find($id, ['id', 'nombre', 'celular_cont', 'cod_estado', 'cargo_cont', 'area_cont', 'correo_cont']);
        $this->nombre = $record->nombre;
        $this->celular_cont = $record->celular_cont;
        $this->estado_cont = $record->cod_estado;
        $this->cargo_cont = $record->cargo_cont;
        $this->area_cont = $record->area_cont;
        $this->correo_cont = $record->correo_cont;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show-modal!');
    }

    public function actualizar()
    {
        $rules = [
            'nombre' => "required|min:3|unique:contactos,nombre,{$this->selected_id}",
            'correo_cont' => "required|unique:contactos,correo_cont,{$this->selected_id}",
            'celular_cont' => 'required',
            'area_cont' => 'required',
            'cargo_cont' => 'required',
            'estado_cont' => 'required',
        ];
        $messages =[
            'nombre.required' => 'Nombre del contacto es requerido',
            'nombre.unique' => 'Ya existe el nombre del contacto',
            'nombre.min' => 'El nombre del contacto debe tener al menos 3 caracteres',
        ];
        $this->validate($rules, $messages);
        $contacto = Contacto::find($this->selected_id);
        $contacto->update([
            'nombre' => $this->nombre,
            'celular_cont' => $this->celular_cont,
            'cod_estado' => $this->estado_cont,
            'cargo_cont' => $this->cargo_cont,
            'area_cont' => $this->area_cont,
            'correo_cont' => $this->correo_cont,
        ]);

        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Contacto actualizado!!',['timerProgressBar' => true]);
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Contacto $contacto)
    {
        $contacto->delete();
        $this->resetUI();
        $this->alert('success', 'Contacto eliminado!!',['timerProgressBar' => true]);
    }

    public function resetUI()
    {
        $this->nombre = '';
        $this->celular_cont = '';
        $this->correo_cont = '';
        $this->cargo_cont = '';
        $this->area_cont = '';
        $this->estado_cont = 'ELEGIR';
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
