<?php

namespace App\Http\Livewire\Mensajes;

use App\Events\MensajeEnviado;
use App\Http\Livewire\ComponenteBase;
use App\Models\Conversacion;
use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class ListaConversacion extends ComponenteBase
{
    public $selectedConversation;

    public $body, $conversations;

    public $contacto, $usuarios, $mensajesSinVer;

    protected $rules = [
        'body' => 'required|string',
    ];

    protected $messages = [
        'body.required' => 'El mensaje es obligatorio',
    ];

    protected $listeners = ['conversacion_id'];

    public function mount()
    {
        $this->indexPage();
    }

    public function render()
    {
        $this->update();
        return view('livewire.mensajes.index')->extends('layouts.tema.app')->section('content');
    }

    public function update()
    {
        $this->contacto();
        $this->conversaciones();
    }

    public function contacto()
    {
        if($this->contacto)
        {
            if(strlen($this->contacto) > 3)
            {
                $this->usuarios = User::contacto($this->contacto)->get();
            }
        }else
        {
            $this->usuarios = [];
        }
    }

    public function conversaciones()
    {
        $this->conversations = Conversacion::with('mensajes')
            ->orderBy('id', 'ASC')
            ->where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->get();
    }

    public function indexPage()
    {
        $this->contacto = '';
        $this->usuarios = [];
        $this->selectedConversation = '';
    }

    public function viewMessage($conversationId)
    {
        $consulta = Mensaje::where('conversacion_id', $conversationId)->get();
        foreach ($consulta as $c){
            if($c->user_id != auth()->id()){
                $c->update([
                    'visto' => 1,
                ]);
            }
        }
        $this->selectedConversation = Conversacion::find($conversationId);
    }

    public  function conversacion_id($conversacion_id)
    {
        //dd($conversacion_id);
    }

    public function nuevoMensaje(User $user)
    {
        $validar = Conversacion::where('receiver_id', $user->id)->get();
        if(count($validar))
        {
            $this->viewMessage($validar[0]->id);
            $this->reset('contacto');
            $this->reset('usuarios');
        }else
        {
            $conversacion = Conversacion::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $user->id,
            ]);
            $this->viewMessage($conversacion->id);
            $this->reset('contacto');
            $this->reset('usuarios');
        }

    }

    public function sendMessage()
    {
        $this->validate();
        $this->crearMensaje();
    }

    public function crearMensaje()
    {
      $mensj=  Mensaje::create([
            'conversacion_id' => $this->selectedConversation->id,
            'user_id' => auth()->id(),
            'body' => $this->body,
            'estado' => 0,
        ]);
        $this->viewMessage($this->selectedConversation->id);
        $this->reset('body');

        if($mensj)
        {
            event(new MensajeEnviado($mensj->conversacion_id));
        }
    }



}
