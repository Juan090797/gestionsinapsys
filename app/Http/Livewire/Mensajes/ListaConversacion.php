<?php

namespace App\Http\Livewire\Mensajes;

use App\Http\Livewire\ComponenteBase;
use App\Models\Conversacion;
use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ListaConversacion extends ComponenteBase
{
    public $selectedConversation, $body;

    public $query, $usuarios;

    protected $rules = [
        'body' => 'required',
    ];

    protected $messages = [
        'body.required' => 'El mensaje es obligatorio',
    ];

    public function updatedQuery()
    {
        $this->usuarios = User::where('name', 'like', '%' . $this->query . '%')->get();
    }

    public function mount()
    {
        $this->query = '';
        $this->usuarios = [];
        $this->selectedConversation = Conversacion::query()
                                    ->where('sender_id', auth()->id())
                                    ->orWhere('receiver_id', auth()->id())
                                    ->first();
    }

    public function nuevoMensaje(User $user)
    {

        $validar = Conversacion::where('receiver_id', $user->id)->get();
        if(count($validar))
        {
            $this->viewMessage($validar[0]->id);
            $this->reset('query');
            $this->reset('usuarios');
        }else
        {
            $conversacion = Conversacion::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $user->id,
            ]);
            $this->viewMessage($conversacion->id);
            $this->reset('query');
            $this->reset('usuarios');
        }

    }

    public function sendMessage()
    {
        $this->validate();

        Mensaje::create([
            'conversacion_id' => $this->selectedConversation->id,
            'user_id' => auth()->id(),
            'body' => $this->body,
        ]);

        $this->reset('body');
        $this->viewMessage($this->selectedConversation->id);
    }

    public function viewMessage($conversationId)
    {
        $this->selectedConversation = Conversacion::findOrFail($conversationId);
    }

    public function render()
    {
        $conversations = Conversacion::query()
                        ->where('sender_id', auth()->id())
                        ->orWhere('receiver_id', auth()->id())
                        ->get();

        $users = User::where('id', '!=', auth()->id())->get();

        return view('livewire.mensajes.index',['conversations' => $conversations, 'users' => $users])->extends('layouts.tema.app')->section('content');
    }
}
