<?php

namespace App\Http\Livewire\Roles;

use App\Http\Livewire\ComponenteBase;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\Permission\Models\Role;

class ListaRoles extends ComponenteBase
{
    use LivewireAlert;
    public $selected_id;
    public $state = [];
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function render()
    {
        $roles = Role::latest()->paginate($this->pagination);
        return view('livewire.roles.lista-roles',['roles' => $roles])->extends('layouts.tema.app')->section('content');
    }
    public function Store()
    {
        $validated = Validator::make($this->state, [
            'name' => 'required|min:3|unique:roles,name',
        ],[
            'name.required' => 'El nombre del rol es requerido',
            'name.min' => 'El nombre del rolo debe tener al menos 3 caracteres',
            'name.unique' => 'El nombre del rol es requerido',
        ])->validate();

        Role::create($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Rol creado!!',['timerProgressBar' => true]);
    }
    public function resetUI()
    {
        $this->state=[];
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
