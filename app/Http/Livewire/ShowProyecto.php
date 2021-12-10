<?php

namespace App\Http\Livewire;

use App\Contracts\Admin\Cotizaciones\DeletesCotizaciones;
use App\Models\Archivo;
use App\Models\Cliente;
use App\Models\Comentario;
use App\Models\Cotizacion;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Proyecto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowProyecto extends Component
{
    use WithFileUploads;

    public $state = [];

    public $proyecto, $canti, $selected_id, $productoid,$total, $itemsQuantity, $contenido, $archivo, $codigo;

    public function mount(Proyecto $proyecto)
    {
        $this->state = $proyecto->toArray();
        $this->proyecto = $proyecto;
        $this->total = 0;
        $this->itemsQuantity = 0;
        $this->selected_id = 0;
        $this->canti = 0;
    }

    public function createArchivo()
    {
        $rules = [
            'archivo' => 'required',
        ];
        $messages =[
            'archivo.required' => 'El archivo es requerido',
        ];
        $this->validate($rules, $messages);
        $name = $this->archivo->getClientOriginalName();
        $archivo = Archivo::create([
            'archivo' => $name,
            'proyecto_id' => $this->state['id']
        ]);

        $this->archivo->storeAs('archivos', $name);
        $this->archivo = '';
        $this->emit('archivo-added', 'Archivo Registrado');
    }

    protected $listeners = ['deleteRow' => 'Destroy', 'delete' => 'eliminarCotizacion', 'create' => 'CrearPedido'];

    public function Destroy(Archivo $archivo)
    {
        $archivo->delete();
        $this->emit('archivo-deleted', 'Archivo Eliminado');
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
        $pedido = Cotizacion::with('CotizacionItem')->find($cotizacion->id);

        $pedido = Pedido::create([
            'codigo'            => $this->codigo,
            'documento'         => '',
            'forma_pago'        => '',
            'cotizacion_id'     => $pedido->id,
            'fecha_vencimiento' => $fecha,
            'cliente_id'        => $pedido->cliente_id,
            'subtotal'          => $pedido->subtotal,
            'total'             => $pedido->total,
            'impuesto'             => $pedido->impuesto,
            'user_id'           => Auth::user()->id,
        ]);

        foreach ($cotizacion->CotizacionItem as $item){
            PedidoDetalle::create([
                'pedido_id'     => $pedido->id,
                'producto_id'   => $item['producto_id'],
                'cantidad'      => $item['cantidad'],
                'precio_u'      => $item['precio'],
                'precio_t'      => $item['monto'],
            ]);
        }
        $this->emit('pedido-creado', 'Pedido Creado');
    }

    public function eliminarCotizacion(DeletesCotizaciones $deleter, Cotizacion $cotizacion)
    {
        $deleter->delete($cotizacion);
        $this->emit('cotizacion-deleted', 'Cotizacion Eliminada');
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

        $comentario = Comentario::create([
            'contenido' => $this->contenido,
            'proyecto_id' => $this->state['id'],
            'user_id' => Auth::user()->id
        ]);
        $this->resetUI();
        $this->emit('comentario-added', 'Comentario Registrado');
    }

    public function resetUI()
    {
        $this->contenido = '';
    }

    public function render()
    {
        $proyecto = $this->proyecto;
        $cotizaciones = Cotizacion::where('proyecto_id', $proyecto->id)->get();
        $archivos = Archivo::where('proyecto_id', $proyecto->id)->get();
        $comentarios = Comentario::where('proyecto_id', $proyecto->id )->latest()->get();
        $f1 = $proyecto->fecha_inicio;
        $f2 = $proyecto->fecha_fin;
        $diff = abs(strtotime($f2) - strtotime($f1));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        return view('livewire.proyectos.show', [
            'users' => User::all(),
            'day' => $days,
            'clientes' => Cliente::all(),
            'cotizaciones' => $cotizaciones,
            'comentarios' => $comentarios,
            'archivos' => $archivos
        ])->extends('layouts.tema.app')->section('content');
    }

}
