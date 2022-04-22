<div>
    @section('cabezera-contenido')
        <a href="{{route('tareas')}}" class="btn btn-primary float-right">Atras</a>
        <h1>Instalacion #{{'INS000'.$instalacion->id}}</h1>
    @endsection
    <div class="content-fluid">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <p>
                                    <b>CLIENTE:</b> <br>
                                    Razon social: {{$instalacion->cliente->razon_social}}<br>
                                    Ruc: {{$instalacion->cliente->ruc}}<br>
                                    Telefono: {{$instalacion->cliente->telefono}}<br>
                                    Celular: {{$instalacion->cliente->celular}}<br>
                                    Direccion: {{$instalacion->cliente->direccion}}
                                </p>
                            </div>
                            <div class="col-4">
                                <p>
                                    <b>PRODUCTO:</b> <br>
                                    Nombre: {{$instalacion->producto->nombre}}<br>
                                    Marca: {{$instalacion->producto->marca->nombre}}<br>
                                    Modelo: {{$instalacion->producto->modelo}}<br>
                                    Serie: #SERIE
                                </p>
                            </div>
                            <div class="col-4">
                                <p>
                                    <b>INSTALACION:</b> <br>
                                    Fecha entrega e instalacion: {{$instalacion->fecha_entrega}}<br>
                                    Estado:<select class="form-control" wire:model="estado">
                                        <option value="ASIGNADO">ASIGNADO</option>
                                        <option value="EN PROCESO">EN PROCESO</option>
                                        <option value="INSTALADO">INSTALADO</option>
                                        <option value="FINALIZADO">FINALIZADO</option>
                                    </select>
                                </p>
                            </div>
                            <div class="col-12">
                                <label for="">NOTAS:</label>
                                <textarea cols="30" rows="5" class="form-control" disabled>{{$instalacion->notas}}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-8">
                                        <h4>Actividades Recientes</h4>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0)" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#theModalComentario">comentar</a>
                                    </div>
                                </div>
                                <div style="overflow-x: hidden; overflow-y: auto;">
                                    @foreach($comentarios as $comentario)
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="{{ $comentario->usuario->profile_photo_url }}">
                                                <span class="username"><a href="#">{{$comentario->usuario->name}}</a></span>
                                                <span class="description">{{ $comentario->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p>{{ $comentario->texto }}</p>
                                            @if($comentario->archivo)
                                                <p><a href="javascript:void(0)" wire:click="descargaArchivoComentario({{ $comentario->id }})" class="link-black text-sm"><i class="fas fa-link mr-1"></i> {{ $comentario->archivo }}</a></p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <a href="javascript:void(0)" class="btn btn-success float-right" data-toggle="modal" data-target="#theModalItem">Agregar</a>
                        <h5><b>Check list documentos</b></h5>
                    </div>
                    <div class="card-body">
                        @foreach($items as $item)
                        <div class="col-12">
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary{{$item->id}}" name="{{$item->id}}" wire:click="itemClick({{$item}})" {{$item->checked == true ? 'checked' : null}}>
                                    <label for="radioPrimary{{$item->id}}">{{$item->titulo}}</label>
                                    <small class="float-right">{{$item->updated_at->diffforhumans()}}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="theModalComentario" tabindex="-1" aria-labelledby="theModalComentario" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="theModal">Agregar comentario</h5>
                    </div>
                    <form wire:submit.prevent="createComentario">
                        <div class="modal-body">
                            <div class="form-group">
                                <textarea type="text" class="form-control" name="contenido" wire:model.defer="contenido" placeholder="Comentario"></textarea>
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" wire:model="archivo">
                                    <label class="custom-file-label">{{$archivo}}</label>
                                </div>
                            </div>
                            @error('archivo') <span class="text-danger er">{{ $message }}</span>@enderror
                            <div wire:loading wire:target="archivo">Cargando.....</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="theModalItem" tabindex="-1" aria-labelledby="theModalItem" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="theModal">Agregar comentario</h5>
                    </div>
                    <form wire:submit.prevent="agregarItem">
                        <div class="modal-body">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="titulo">Titulo</label>
                                    <input type="text" id="titulo" class="form-control" placeholder="TITULO" wire:model.defer="titulo">
                                </div>
                                @error('titulo') <span class="text-danger er">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.livewire.on('hide-modal', msg =>{
                $('#theModalComentario').modal('hide');
            })
            window.livewire.on('hide-modal-item', msg =>{
                $('#theModalItem').modal('hide');
            })
        });
        function Confirm(id)
        {
            Swal.fire({
                title: 'CONFIRMAR',
                text: "¿CONFIRMAS ELIMINAR EL REGISTRO?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if(result.value){
                    window.livewire.emit('deleteRow', id)
                    swal.close()
                }
            })
        }
    </script>
</div>

