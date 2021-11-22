<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Industria;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;

    public $nombre, $correo, $direccion, $estado, $pagina_web,$telefono, $descripcion, $ruc, $razon_social, $detalle_banco,
        $ciudad_entrega, $ciudad_recojo, $direccion_entrega, $direccion_recojo, $pais_entrega, $pais_recojo, $usuario_auditoria,
        $industriaid,$categoriaid,$search, $selected_id;

    protected $paginationTheme = 'bootstrap';

    Private $pagination = 10;

    public function  updatingSearch()
    {
        $this->resetPage();
    }


    public function mount()
    {
        $this->selected_id = 0;
    }

    public function render()
    {
        if(strlen($this->search) > 0) {
            $data = Cliente::where('razon_social', 'like', '%' . $this->search . '%')
                            ->orWhere('ruc', 'like', '%' . $this->search . '%')
                            ->paginate($this->pagination);
        }else {
            $data = Cliente::orderBy('id', 'desc')->paginate($this->pagination);
        }
        return view('livewire.clientes.clientes',[
            'clientes' => $data,
            'industrias' => Industria::all(),
            'categorias' => Categoria::all(),
        ])->extends('layouts.tema.app')->section('content');
    }

    public function Store()
    {
        $rules = [
            'nombre' => 'required|unique:clientes|min:3',
            'correo' => 'required|unique:clientes',
            'direccion' => 'required',
            'estado' => 'required',
            'pagina_web' => '',
            'telefono' => 'required',
            'descripcion' => '',
            'ruc' => 'required|unique:clientes',
            'razon_social' => 'required|unique:clientes',
            'detalle_banco' => '',
            'ciudad_entrega' => '',
            'ciudad_recojo' => '',
            'direccion_entrega' => '',
            'direccion_recojo' => '',
            'pais_entrega' => '',
            'pais_recojo' => '',
            'usuario_auditoria' => '',
            'industriaid' => 'required',
            'categoriaid' => 'required',
        ];
        $messages =[
            'nombre.required' => 'Nombre del cliente es requerido',
            'nombre.unique' => 'Ya existe el nombre del cliente',
            'nombre.min' => 'El nombre del cliente debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
            'direccion.required' => 'La direccion es requerida',
            'telefono.required' => 'EL telefono es requerido',
            'ruc.required' => 'El ruc es requerido',
            'razon_social.required' => 'La razon social es requerido',
            'industriaid.required' => 'La industria es requerida',
            'categoriaid.required' => 'La categoria es requerida',
        ];

        $this->validate($rules, $messages);

        $cliente = Cliente::create([
            'nombre' => $this->nombre,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
            'estado' => $this->estado,
            'pagina_web' => $this->pagina_web,
            'telefono' => $this->telefono,
            'descripcion' => $this->descripcion,
            'ruc' => $this->ruc,
            'razon_social' => $this->razon_social,
            'detalle_banco' => $this->detalle_banco,
            'ciudad_entrega' => $this->ciudad_entrega,
            'ciudad_recojo' => $this->ciudad_recojo,
            'direccion_entrega' => $this->direccion_entrega,
            'direccion_recojo' => $this->direccion_recojo,
            'pais_entrega' => $this->pais_entrega,
            'pais_recojo' => $this->pais_recojo,
            'usuario_auditoria' => Auth::user()->name,
            'industria_id' => $this->industriaid,
            'categoria_id' => $this->categoriaid,
        ]);

        $this->resetUI();
        $this->emit('cliente-added', 'Cliente Registrado');
    }

    public function resetUI()
    {
        $this->nombre = '';
        $this->correo = '';
        $this->direccion = '';
        $this->pagina_web = '';
        $this->telefono = '';
        $this->descripcion = '';
        $this->ruc = '';
        $this->razon_social = '';
        $this->detalle_banco = '';
        $this->ciudad_entrega = '';
        $this->ciudad_recojo = '';
        $this->direccion_entrega = '';
        $this->direccion_recojo = '';
        $this->pais_entrega = '';
        $this->pais_recojo = '';
        $this->usuario_auditoria = '';
        $this->industriaid = 'ELEGIR';
        $this->categoriaid = 'ELEGIR';
        $this->estado = 'ELEGIR';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }

    public function Edit($id)
    {
        $record = Cliente::find($id,
            ['id', 'nombre', 'correo','direccion', 'estado', 'pagina_web', 'telefono','descripcion', 'ruc', 'razon_social','detalle_banco', 'ciudad_entrega',
                'ciudad_recojo','direccion_entrega', 'direccion_recojo', 'pais_entrega', 'pais_recojo', 'industria_id', 'categoria_id' ]);
        $this->nombre = $record->nombre;
        $this->correo = $record->correo;
        $this->direccion = $record->direccion;
        $this->estado = $record->estado;
        $this->pagina_web = $record->pagina_web;
        $this->telefono = $record->telefono;
        $this->descripcion = $record->descripcion;
        $this->ruc = $record->ruc;
        $this->razon_social = $record->razon_social;
        $this->detalle_banco = $record->detalle_banco;
        $this->ciudad_entrega = $record->ciudad_entrega;
        $this->ciudad_recojo = $record->ciudad_recojo;
        $this->direccion_entrega = $record->direccion_entrega;
        $this->direccion_recojo = $record->direccion_recojo;
        $this->pais_entrega = $record->pais_entrega;
        $this->pais_recojo = $record->pais_recojo;
        $this->industriaid = $record->industria_id;
        $this->categoriaid = $record->categoria_id;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show-modal!');
    }

    public function Update()
    {
        $rules = [
            'nombre' => "required|min:3|unique:clientes,nombre,{$this->selected_id}",
            'correo' => "required|unique:clientes,correo,{$this->selected_id}",
            'direccion' => 'required',
            'estado' => 'required',
            'pagina_web' => '',
            'telefono' => 'required',
            'descripcion' => '',
            'ruc' => "required|unique:clientes,ruc,{$this->selected_id}",
            'razon_social' => "required|unique:clientes,razon_social,{$this->selected_id}",
            'detalle_banco' => '',
            'ciudad_entrega' => '',
            'ciudad_recojo' => '',
            'direccion_entrega' => '',
            'direccion_recojo' => '',
            'pais_entrega' => '',
            'pais_recojo' => '',
            'usuario_auditoria' => '',
            'industriaid' => 'required',
            'categoriaid' => 'required',
        ];
        $messages =[
            'nombre.required' => 'Nombre del cliente es requerido',
            'nombre.unique' => 'Ya existe el nombre del cliente',
            'nombre.min' => 'El nombre del cliente debe tener al menos 3 caracteres',
            'estado.required' => 'El estado es requerido',
            'direccion.required' => 'La direccion es requerida',
            'telefono.required' => 'EL telefono es requerido',
            'ruc.required' => 'El ruc es requerido',
            'razon_social.required' => 'La razon social es requerido',
            'industriaid.required' => 'La industria es requerida',
            'categoriaid.required' => 'La categoria es requerida',
        ];

        $this->validate($rules, $messages);
        $cliente = Cliente::find($this->selected_id);
        $cliente->update([
            'nombre' => $this->nombre,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
            'estado' => $this->estado,
            'pagina_web' => $this->pagina_web,
            'telefono' => $this->telefono,
            'descripcion' => $this->descripcion,
            'ruc' => $this->ruc,
            'razon_social' => $this->razon_social,
            'detalle_banco' => $this->detalle_banco,
            'ciudad_entrega' => $this->ciudad_entrega,
            'ciudad_recojo' => $this->ciudad_recojo,
            'direccion_entrega' => $this->direccion_entrega,
            'direccion_recojo' => $this->direccion_recojo,
            'pais_entrega' => $this->pais_entrega,
            'pais_recojo' => $this->pais_recojo,
            'usuario_auditoria' => Auth::user()->name,
            'industria_id' => $this->industriaid,
            'categoria_id' => $this->categoriaid,
        ]);

        $this->resetUI();
        $this->emit('cliente-updated', 'Cliente Actualizado');
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Cliente $cliente)
    {
        $cliente->delete();

        $this->resetUI();
        $this->emit('cliente-deleted', 'Cliente Eliminado');
    }

}
