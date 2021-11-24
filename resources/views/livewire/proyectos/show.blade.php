<div>
    @section('cabezera-contenido')
        <a href="{{url('proyectos')}}" class="btn btn-primary float-right">Atras</a>
        <h1>Proyecto #{{$proyecto->id }}</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalle del Proyecto</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Presupuesto Estimado</span>
                                        <span class="info-box-number text-center text-muted mb-0">S/ {{number_format($proyecto->ingreso_estimado,2)}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Cantidad Total a Gastar</span>
                                        <span class="info-box-number text-center text-muted mb-0">S/ {{number_format($proyecto->gasto_estimado,2)}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Duracion estimada del Proyecto</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{$day}} días </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4>Actividades Recientes({{$comentarios->count()}})</h4>
                                <form wire:submit.prevent="createComentario">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="contenido" wire:model.defer="contenido" placeholder="Comentar">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-success float-righ" type="submit">Agregar</button>
                                        </div>
                                    </div>
                                    @error('contenido') <span class="text-danger er">{{ $message }}</span>@enderror
                                </form>
                                <div  style="overflow-x: hidden; overflow-y: auto; height: 14cm">
                                @forelse($comentarios as $comentario)
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="{{ $comentario->user->profile_photo_url }}" alt="user image">
                                            <span class="username">
                                                <a href="#" wire:model="{{$comentario->user->name}}">{{$comentario->user->name}}</a>
                                            </span>
                                            <span class="description">{{$comentario->created_at->diffForHumans()}}</span>
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
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary"><i class="fas fa-paint-brush"></i>{{$proyecto->nombre}}</h3>
                        <br>
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
                        <div class="row">
                            <div class="col-6">
                                <h5 class="mt-3 text-muted">Archivos({{$archivos->count()}})</h5>
                                <ul class="list-unstyled">
                                    @forelse($archivos as $a)
                                    <li>
                                        <a href="javascript:void(0)" wire:click="descarga({{ $a->id }})" class="btn-link text-secondary mr-2"><i class="far fa-fw fa-file-word"></i>{{$a->archivo}}</a>
                                        <a href="javascript:void(0)" onclick="Confirm('{{ $a->id }}')" class="btn-link text-secondary"><i class="far fa-trash-alt"></i></a>
                                    </li>
                                    @empty
                                        <p class="text-danger">0 archivos</p>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="col-6">
                                <h5 class="mt-3 text-muted">Cotizaciones({{$cotizaciones->count()}})</h5>
                                <ul class="list-unstyled">
                                    @forelse($cotizaciones as $cotizacion)
                                        <li>
                                            <a class="btn-link text-secondary mr-2"><i class="far fa-fw fa-file-pdf"></i>Cotizacion_{{$loop->iteration}}</a>
                                            <a href="{{ route('cotizacion.show',$cotizacion) }}" class="btn-link text-secondary"><i class="far fa-eye"></i></a>
                                            <a href="{{ route('cotizacion.edit', $cotizacion) }}" class="btn-link text-secondary"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="javascript:void(0)" onclick="Confirmar('{{ $cotizacion->id }}')" class="btn-link text-secondary"><i class="far fa-trash-alt"></i></a>
                                        </li>
                                    @empty
                                        <p class="text-danger">0 cotizaciones</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="mt-1">
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#theModal">Agregar archivo</a>
                            <a href="{{route('cotizacion',$proyecto)}}" class="btn btn-sm btn-success">Agregar Cotizacion</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
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
    </script>
</div>
