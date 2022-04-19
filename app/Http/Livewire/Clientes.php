<?php

namespace App\Http\Livewire;

use App\Exports\ClienteExport;
use App\Imports\ClienteImport;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Industria;
use App\Models\TipoDocumento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Clientes extends ComponenteBase
{
    use WithFileUploads;
    use LivewireAlert;
    public $state= [];
    public $search, $selected_id,$documentos,$industrias,$categorias,$file;
    protected $listeners = ['deleteRow' => 'Destroy'];

    public function  updatingSearch()
    {
        $this->resetPage();
    }
    public function mount()
    {
        $this->selected_id = 0;
        $this->state= ['usuario_auditoria' => Auth::user()->name,];
    }
    public function render()
    {
        if(strlen($this->search) > 0) {
            $data = Cliente::where('razon_social', 'like', '%' . $this->search . '%')
                            ->where('estado','ACTIVO')
                            ->orWhere('ruc', 'like', '%' . $this->search . '%')
                            ->paginate($this->pagination);
        }else {
            $data = Cliente::where('estado','ACTIVO')->paginate($this->pagination);
        }
        $this->update();
        return view('livewire.clientes.clientes',['clientes' => $data,])->extends('layouts.tema.app')->section('content');
    }
    public function update()
    {
        $this->documentos();
        $this->industrias();
        $this->categorias();
    }
    public function documentos()
    {
        $this->documentos = TipoDocumento::where('tipo', 'identidad')->get();
    }
    public function industrias()
    {
        $this->industrias = Industria::all();
    }
    public function categorias()
    {
        $this->categorias = Categoria::all();
    }
    public function resetUI()
    {
        $this->state = [];
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
        $this->file = null;
    }
    public function Store()
    {
        $validated = Validator::make($this->state, [
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
            'industria_id' => 'required',
            'categoria_id' => 'required',
        ],
        [
            'nombre.required' => 'El nombre del cliente es requerido',
            'nombre.unique' => 'Ya existe el nombre del cliente',
            'nombre.min' => 'El nombre del cliente debe tener al menos 3 caracteres',
            'correo.required' => 'El correo del cliente es requerido',
            'estado.required' => 'El estado es requerido',
            'direccion.required' => 'La direccion es requerida',
            'telefono.required' => 'EL telefono es requerido',
            'ruc.required' => 'El ruc es requerido',
            'razon_social.required' => 'La razon social es requerido',
            'industria_id.required' => 'La industria es requerida',
            'categoria_id.required' => 'La categoria es requerida',
        ])->validate();

        Cliente::create($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Cliente registrado!!',['timerProgressBar' => true]);
    }
    public function Edit(Cliente $cliente)
    {
        $this->selected_id = $cliente->id;
        $this->state = $cliente->toArray();
        $this->emit('show-modal');
    }
    public function actualizar()
    {
        $validated = Validator::make($this->state, [
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
            'industria_id' => 'required',
            'categoria_id' => 'required',
        ],
            [
                'nombre.required' => 'Nombre del cliente es requerido',
                'nombre.unique' => 'Ya existe el nombre del cliente',
                'nombre.min' => 'El nombre del cliente debe tener al menos 3 caracteres',
                'correo.required' => 'El correo del cliente es requerido',
                'estado.required' => 'El estado es requerido',
                'direccion.required' => 'La direccion es requerida',
                'telefono.required' => 'EL telefono es requerido',
                'ruc.required' => 'El ruc es requerido',
                'razon_social.required' => 'La razon social es requerido',
                'industria_id.required' => 'La industria es requerida',
                'categoria_id.required' => 'La categoria es requerida',
            ])->validate();

        $cliente = Cliente::findOrFail($this->state['id']);
        $cliente->update($validated);
        $this->resetUI();
        $this->emit('hide-modal');
        $this->alert('success', 'Cliente actualizado!!',['timerProgressBar' => true]);
    }
    public function Destroy(Cliente $cliente)
    {
        $cliente->update(['estado' => 'INACTIVO']);
        $this->resetUI();
        $this->alert('success', 'Cliente eliminado!!',['timerProgressBar' => true]);
    }
    public function exportClientes()
    {
        $reportName = 'Clientes_' . uniqid() . '.xlsx';
        return Excel::download(new ClienteExport, $reportName);
    }
    public function importCliente()
    {
        $import = new ClienteImport();
        $import->import($this->file);
        if ($import->failures()->isNotEmpty())
        {
            $this->resetUI();
            $this->alert('error', 'Error en la importacion!!',['timerProgressBar' => true]);
        }else{
            $this->resetUI();
            $this->alert('success', 'Clientes importados!!',['timerProgressBar' => true]);
        }
    }
}
