<?php

namespace App\Http\Livewire;

use App\Contracts\Admin\Cotizaciones\DeletesCotizaciones;
use App\Models\Archivo;
use App\Models\Cliente;
use App\Models\Comentario;
use App\Models\Cotizacion;
use App\Models\Etapa;
use App\Models\Garantia;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Proyecto;
use App\Models\ProyectoUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowProyecto extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $state = [];
    public $team;
    public $proyecto, $canti, $selected_id, $productoid,$total, $itemsQuantity, $contenido, $archivo, $codigo, $archivo_c;
    public $archivos, $comentarios, $cotizaciones, $users, $clientes,$etapas,$pedidoNuevo;

    protected $listeners = ['deleteRow' => 'Destroy', 'delete' => 'eliminarCotizacion', 'create' => 'CrearPedido'];

    public function mount(Proyecto $proyecto)
    {
        $this->state = $proyecto->toArray();
        $this->proyecto = $proyecto;
    }
    public function render()
    {
        $this->update();
        $this->indexPage();
        return view('livewire.proyectos.show')->extends('layouts.tema.app')->section('content');
    }
    public function indexPage()
    {
        $this->total = 0;
        $this->itemsQuantity = 0;
        $this->selected_id = 0;
        $this->canti = 0;
    }
    public function update()
    {
        $this->proyectoUpdate();
        $this->archivos();
        $this->comentarios();
        $this->cotizaciones();
        $this->users();
        $this->clientes();
        $this->etapas();
    }
    public function proyectoUpdate()
    {
        $this->proyecto = Proyecto::find($this->proyecto->id);
    }
    public function archivos()
    {
        $this->archivos = Archivo::where('proyecto_id', $this->proyecto->id)->get();
    }
    public function comentarios()
    {
        $this->comentarios = Comentario::where('proyecto_id', $this->proyecto->id )->latest()->get();
    }
    public function cotizaciones()
    {
        $this->cotizaciones = Cotizacion::where('proyecto_id', $this->proyecto->id)->get();
    }
    public function users()
    {
        $this->users = User::all();
    }
    public function clientes()
    {
        $this->clientes = Cliente::all();
    }
    public function etapas()
    {
        $this->etapas = Etapa::all();
    }
    public function cambiarEtapa(Etapa $etapa)
    {
        $this->proyecto->update(['etapa_id' => $etapa->id,]);
        $this->alert('success', 'Se actualizo la etapa',['timerProgressBar' => true]);
    }
    public function createArchivo()
    {
        $rules = [
            'archivo_p' => 'required',
        ];
        $messages =[
            'archivo.required' => 'El archivo es requerido',
        ];
        $this->validate($rules, $messages);
        $name = $this->archivo->getClientOriginalName();
        $archivo = Archivo::create([
            'archivo_' => $name,
            'proyecto_id' => $this->state['id']
        ]);

        $this->archivo->storeAs('archivos', $name);
        $this->archivo = '';
        $this->emit('archivo-added');
        $this->alert('success', 'Archivo registrado',['timerProgressBar' => true]);
    }
    public function Destroy(Archivo $archivo)
    {
        $archivo->delete();
        $this->alert('success', 'Archivo eliminado',['timerProgressBar' => true]);
    }
    public function CrearPedido(Cotizacion $cotizacion)
    {
        if(Pedido::count() > 0){
            $i = Pedido::latest()->first()->id +1;
        }else{
            $i = 1;
        }
        $date = Carbon::now();
        $date = $date->Format('ym');
        if($i <= 9){
            $this->codigo = 'PE'. $date .'0000'. $i;
        }elseif ($i <= 100){
            $this->codigo = 'PE'. $date .'000'. $i;
        }elseif ($i <= 1000){
            $this->codigo = 'PE'. $date .'00'. $i;
        }elseif ($i <= 10000){
            $this->codigo = 'PE'. $date .'0'. $i;
        }else{
            $this->codigo = 'PE'. $date. $i;
        }
        $fecha = Carbon::now();
        $fecha = $fecha->format('Y-m-d');
        $coti = Cotizacion::with('CotizacionItem')->find($cotizacion->id);

        DB::transaction(function() use($coti,$fecha) {
            $pedido = Pedido::create([
                'codigo'            => $this->codigo,
                'estado'            => 'EN PROCESO',
                'cotizacion_id'     => $coti->id,
                'atendido'          => $coti->atendido,
                'fecha_pedido'      => $fecha,
                'plazo_entrega'     => $coti->plazo_entrega,
                'txt_plazo'         => $coti->txt_plazo,
                'garantia'          => $coti->garantia,
                'txt_garantia'      => $coti->txt_garantia,
                'num_mantenimiento' => $coti->num_mantenimiento,
                'txt_mantenimiento' => $coti->txt_mantenimiento,
                'direccion_entrega' => $coti->direccion_entrega,
                'cliente_id'        => $coti->cliente_id,
                'subtotal'          => $coti->subtotal,
                'total'             => $coti->total,
                'total_items'       => $coti->total_items,
                'impuesto'          => $coti->impuesto,
                'user_id'           => Auth::user()->id,
            ]);
            $this->pedidoNuevo = $pedido->codigo;
            foreach ($coti->CotizacionItem as $item){
                PedidoDetalle::create([
                    'pedido_id'     => $pedido->id,
                    'producto_id'   => $item['producto_id'],
                    'descripcion'   => $item['descripcion'],
                    'cantidad'      => $item['cantidad'],
                    'precio_u'      => $item['precio_u'],
                    'precio_t'      => $item['precio_t'],
                ]);
            }
        });
        $this->alert('success', "Se creo el pedido $this->pedidoNuevo",['timerProgressBar' => true]);
    }
    public function eliminarCotizacion(DeletesCotizaciones $deleter, Cotizacion $cotizacion)
    {
        $deleter->delete($cotizacion);
        $this->alert('success', 'Cotizacion eliminada',['timerProgressBar' => true]);
    }
    public function descarga($id)
    {
        $ardesc = Archivo::where('id', $id)->pluck('archivo')->all();
        return Storage::disk('local')->download('archivos/'.$ardesc[0]);
    }
    public function createComentario()
    {
        $rules = [
            'contenido' => 'required|unique:comentarios|min:3',
        ];
        $messages =[
            'contenido.required' => 'El comentario es requerido',
        ];

        $this->validate($rules, $messages);

        if($this->archivo_c)
        {
            $name = $this->archivo_c->getClientOriginalName();
            $this->archivo_c->storeAs('archivoscomentarios', $name);
            $comentario = Comentario::create([
                'contenido' => $this->contenido,
                'archivo_c' => $name,
                'proyecto_id' => $this->state['id'],
                'user_id' => Auth::user()->id
            ]);
        }else{
            $comentario = Comentario::create([
                'contenido' => $this->contenido,
                'archivo_c' => '',
                'proyecto_id' => $this->state['id'],
                'user_id' => Auth::user()->id
            ]);
        }
        $this->resetUI();
        $this->archivo_c = '';
        $this->emit('comentario-added');
        $this->alert('success', 'Comentario agregado',['timerProgressBar' => true]);
    }
    public function descargaArchivoComentario(Comentario $comentario)
    {
        $ardescargacomentario = $comentario->archivo_c;
        return Storage::disk('local')->download('archivoscomentarios/'.$ardescargacomentario);
    }
    public function resetUI()
    {
        $this->contenido = '';
    }
    public function borrarColaborador(ProyectoUser $proyectoUser)
    {
        $proyectoUser->delete();
        $this->alert('success', 'Se elimino el colaborador con exito',['timerProgressBar' => true]);
    }
    public function createEquipo()
    {
        if($this->team){
            $this->proyecto->colaboradores()->create(['user_id' => $this->team]);
            $this->emit('cerrar-modal');
            $this->alert('success', 'Se agrego el colaborador con exito',['timerProgressBar' => true]);
        }else{
            $this->emit('cerrar-modal');
            $this->alert('error', 'No se selecciono colaborador',['timerProgressBar' => true]);
        }
    }
}
