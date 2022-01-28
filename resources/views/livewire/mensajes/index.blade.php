<div>
    <div class="pt-2 row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">CHATS</h3>
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar usuarios" wire:model="contacto">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                    @if(!empty($usuarios))
                        @foreach($usuarios as $user)
                            <ul id="2" class="contacts-list">
                                <li>
                                    <a href="#" wire:click.prevent="nuevoMensaje( {{ $user->id }})">
                                        <img class="contacts-list-img" src="{{ $user->profile_photo_url }}" alt="User Avatar">
                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name text-dark">
                                                {{ $user->name }}
                                            </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        @endforeach
                    @endif
                    <hr>
                    <ul class="contacts-list">
                    @foreach ($conversations as $conversation)
                        @if($selectedConversation)
                            <li class="{{ $conversation->id === $selectedConversation->id ? 'bg-warning' : '' }}">
                                <a href="#" wire:click.prevent="viewMessage( {{ $conversation->id }})">
                                    <img class="contacts-list-img" src="{{ $conversation->receiver->profile_photo_url }}" alt="User Avatar">
                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name text-dark">
                                            @if(Auth::user()->name == $conversation->receiver->name)
                                                {{ $conversation->sender->name }}
                                            @else
                                                {{ $conversation->receiver->name }}
                                            @endif
                                            <small class="float-right contacts-list-date text-muted">{{ $conversation->mensajes->last()?->created_at->diffForHumans() }}</small>
                                        </span>
                                        <span class="contacts-list-msg text-secondary">{{ $conversation->mensajes->last()?->body }}</span>
                                        @if($conversation->mensajes_no->mensajes_count > 0)
                                            @if($conversation->mensajes->last()?->user_id != Auth::user()->id)
                                                <span class="float-right badge badge-danger">{{$conversation->mensajes_no->mensajes_count}}</span>
                                            @endif
                                        @endif
                                    </div>
                                </a>
                            </li>
                        @else
                                <li>
                                    <a href="#" wire:click.prevent="viewMessage( {{ $conversation->id }})">
                                        <img class="contacts-list-img" src="{{ $conversation->receiver->profile_photo_url }}" alt="User Avatar">
                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name text-dark">
                                                @if(Auth::user()->name == $conversation->receiver->name)
                                                    {{ $conversation->sender->name }}
                                                @else
                                                    {{ $conversation->receiver->name }}
                                                @endif
                                                <small class="float-right contacts-list-date text-muted">{{ $conversation->mensajes->last()?->created_at->diffForHumans() }}</small>
                                            </span>
                                            <span class="contacts-list-msg text-secondary">{{ $conversation->mensajes->last()?->body }}</span>
                                            @if($conversation->mensajes_no->mensajes_count > 0)
                                                @if($conversation->mensajes->last()?->user_id !== Auth::user()->id)
                                                    <span class="float-right badge badge-danger">{{$conversation->mensajes_no->mensajes_count}}</span>
                                                @endif
                                            @endif
                                        </div>
                                    </a>
                                </li>
                        @endif
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @if($selectedConversation)
                <div class="card direct-chat direct-chat-primary">
                    <div class="card-header">
                        <h3 class="card-title">Chat con
                            <span>
                                {{ $selectedConversation->receiver->name }}
                            </span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="direct-chat-messages" id="conversation" style="height: 400px!important;">
                            @if(count($selectedConversation->mensajes))
                                @foreach($selectedConversation->mensajes as $message)
                                    <div class="direct-chat-msg {{ $message->user_id === auth()->id() ? 'right' : '' }}">
                                        <div class="clearfix direct-chat-infos">
                                            <span class="float-left direct-chat-name">{{ $message->user->name }}</span>
                                            <span class="float-right direct-chat-timestamp">{{ $message->created_at->format('d M h:i a') }}</span>
                                        </div>
                                        <img class="direct-chat-img" src="{{ $message->user->profile_photo_url }}" alt="message user image">
                                        <div class="direct-chat-text">
                                            {{ $message->body }}
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h2 class="text-center">Sin mensajes</h2>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <form wire:submit.prevent="sendMessage">
                            <div class="input-group">
                                <input wire:model.defer="body" type="text" name="body" placeholder="Escribe un mensaje ..." class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">enviar</button>
                                </span>
                            </div>
                            @error('body') <span class="text-danger er">{{ $message }}</span>@enderror
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('934510425d1de4fc4645', {
            cluster: 'us2'
        });
        var channel = pusher.subscribe('chat-chanel');
        channel.bind('chat-event', function(data) {
            window.livewire.emit('conversacion_id', data);
        });
    </script>
</div>
