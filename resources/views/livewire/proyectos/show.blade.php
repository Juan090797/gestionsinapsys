<div>
    @section('cabezera-contenido')
        <a href="{{url('proyectos')}}" class="btn btn-primary float-right">Atras</a>
        <h1>{{$proyecto->nombre }}</h1>
    @endsection
    <div class="content-fluid">
        <div>
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Actividades({{$comentarios->count()}})</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Cotizaciones({{$cotizaciones->count()}})</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Archivos({{$archivos->count()}})</a></li>
            </ul>
            <div class="tab-content mt-3">
                <div class="active tab-pane" id="activity">
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>Actividades Recientes({{$comentarios->count()}})</h4>
                                        </div>
                                        <div class="col-4">
                                            <a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#theModalComentario">comentar</a>
                                        </div>
                                    </div>
                                    <div style="overflow-x: hidden; overflow-y: auto;">
                                        @forelse($comentarios as $comentario)
                                            <div class="post">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm" src="{{ $comentario->user->profile_photo_url }}" alt="user image">
                                                    <span class="username">
                                                        <a href="#" wire:model="{{$comentario->user->name}}">{{$comentario->user->name}}</a>
                                                    </span>
                                                    <span class="description">{{$comentario->created_at->diffForHumans()}}</span>
                                                    @if($comentario->archivo_c)
                                                        <span class="float-left"><a href="javascript:void(0)" wire:click="descargaArchivoComentario({{ $comentario->id }})" class="btn-link text-primary">{{$comentario->archivo_c}}</a></span>
                                                    @endif
                                                </div>
                                                <p>{{$comentario->contenido}}</p>
                                            </div>
                                        @empty
                                            <p class="text-danger">0 comentarios</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted">
                                        <p class="text-sm">Empresa Cliente
                                            <b class="d-block">{{$proyecto->cliente->razon_social}}</b>
                                        </p>
                                        <p class="text-sm">Lider Proyecto
                                            <b class="d-block">{{$proyecto->user->name}}</b>
                                        </p>
                                        <p class="text-sm">Equipo Proyecto
                                            @if($proyecto->team)
                                                @foreach($proyecto->team as $t)
                                                    <b class="d-block">{{$t}}</b>
                                                @endforeach
                                            @else
                                                <p class="text-danger">Sin equipo</p>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="timeline">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="{{route('cotizacion',$proyecto)}}" class="btn btn-sm btn-success">Agregar Cotizacion</a>
                                </div>
                                <div class="card-body">
                                    @if(count($cotizaciones))
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th class="text-center">Codigo</th>
                                                <th class="text-center">F.Creado</th>
                                                <th class="text-center">F.Actualizado</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($cotizaciones as $cotizacion)
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <td class="text-center">{{$cotizacion->codigo}}</td>
                                                    <td class="text-center">{{$cotizacion->created_at}}</td>
                                                    <td class="text-center">{{$cotizacion->updated_at}}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('cotizacion.show',$cotizacion) }}" class="btn-link text-secondary"><i class="far fa-eye"></i></a>
                                                        <a href="{{ route('cotizacion.edit', $cotizacion) }}" class="btn-link text-secondary"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="javascript:void(0)" onclick="Confirmar('{{ $cotizacion->id }}')" class="btn-link text-secondary"><i class="far fa-trash-alt"></i></a>
                                                        <a href="javascript:void(0)" onclick="Confirmacion('{{ $cotizacion->id }}')" class="btn-link text-secondary"><i class="fas fa-clipboard-check"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-danger">0 Cotizaciones</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="settings">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#theModal">Agregar archivo</a>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        @forelse($archivos as $a)
                                            <li>
                                                <a href="javascript:void(0)" wire:click="descarga({{ $a->id }})" class="btn-link text-secondary mr-2"><i class="far fa-fw fa-file-word"></i>{{$a->archivo}}</a>
                                                <a href="javascript:void(0)" onclick="Confirm('{{ $a->id }}')" class="btn-link text-secondary"><i class="far fa-trash-alt"></i></a>
                                            </li>
                                        @empty
                                            <p class="text-danger">0 Archivos</p>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="theModal" tabindex="-1" aria-labelledby="theModal" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="theModal">Agregar archivo</h5>
                    </div>
                    <form wire:submit.prevent="createArchivo">
                        <div class="modal-body">
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
                                    <input type="file" class="custom-file-input" wire:model="archivo_c">
                                    <label class="custom-file-label">{{$archivo_c}}</label>
                                </div>
                            </div>
                            @error('archivo_c') <span class="text-danger er">{{ $message }}</span>@enderror
                            <div wire:loading wire:target="archivo_c">Cargando.....</div>
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
            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('archivo-added', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            });
            window.livewire.on('proyecto-updated', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            });
            window.livewire.on('archivo-deleted', msg =>{
                noty(msg)
            });
            window.livewire.on('cotizacion-deleted', msg =>{
                noty(msg)
            });
            window.livewire.on('producto-ok', msg =>{
                noty(msg)
            });
            window.livewire.on('comentario-added', msg =>{
                $('#theModalComentario').modal('hide');
                noty(msg)
            });
            window.livewire.on('pedido-creado', msg =>{
                noty(msg)
            });
        });

        function Confirm(id)
        {
            swal({
                title: 'CONFIRMAR',
                text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#fff',
                confirmButtonText: 'Aceptar',
                getConfirmButtonColor: '#3B3F5C'
            }).then(function (result){
                if(result.value){
                    window.livewire.emit('deleteRow', id)
                    swal.close()
                }
            })
        }
        function Confirmar(id)
        {
            swal({
                title: 'CONFIRMAR',
                text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#fff',
                confirmButtonText: 'Aceptar',
                getConfirmButtonColor: '#3B3F5C'
            }).then(function (result){
                if(result.value){
                    window.livewire.emit('delete', id)
                    swal.close()
                }
            })
        }
        function Confirmacion(id)
        {
            swal({
                title: 'CONFIRMAR',
                text: '¿CONFIRMAS CREAR EL PEDIDO?',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                cancelButtonColor: '#fff',
                confirmButtonText: 'Aceptar',
                getConfirmButtonColor: '#3B3F5C'
            }).then(function (result){
                if(result.value){
                    window.livewire.emit('create', id)
                    swal.close()
                }
            })
        }
    </script>
</div>
