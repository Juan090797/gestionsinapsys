<div>
    @push('styles')
        <style>
            @media (max-width: 767px) {
                .btn-breadcrumb { margin-left: 10px; margin-right: 10px; width: calc(100% - 20px) !important; }
            }

            #etapa{
                text-decoration: none;
            }
            .btn-breadcrumb{
                width: 100%;
                background-color: #fff;
                border-radius: 4px;
                border: solid 1px #ccc;
            }
            .btn-breadcrumb .btn{
                border-color: transparent; border: 0px solid transparent;
                border-right: 1px solid transparent !important;
                font-size: 11px;
            }
            .breadcrumb-default{ background-color: #fff; }
            .btn-primary,.breadcrumb-primary{ background-color: #337ab7; }
            .btn-primary:hover{background-color: #286090;}

            .breadcrumb-success{ background-color: #5cb85c; }
            .breadcrumb-info{ background-color: #5bc0de; }
            .breadcrumb-warning{ background-color: #f0ad4e; }
            .breadcrumb-danger{ background-color: #d9534f; }
            .breadcrumb-negro{ background-color: #d4d4d4; }

            .btn-breadcrumb .btn:last-child:after{margin-left: -2px;}
            .btn-breadcrumb .btn:last-child:before{margin-left: -1px;}

            .btn-breadcrumb .btn-derecha{
                float: right;
                margin-right: 0px;
                padding: 6px 10px 6px 10px !important;
                margin-left: 0px !important;
                border-radius: 0px !important;
            }
            .btn-breadcrumb .btn-derecha:first-child {
                border-top-right-radius: 2px !important;
                border-bottom-right-radius: 2px !important;
            }

            .btn-breadcrumb .btn-derecha:after, .btn-breadcrumb .btn-derecha:before{
                content: none !important;
            }

            .btn-breadcrumb .btn:after {
                content: " ";
                display: block;
                width: 0;
                height: 0;
                border-top: 13px solid transparent;
                border-bottom: 14px solid transparent;
                border-left: 10px solid white;
                position: absolute;
                top: 50%;
                margin-top: -14px;
                margin-left: 0px;
                left: 100%;
                z-index: 3;
            }
            .btn-breadcrumb .btn:before {
                content: " ";
                display: block;
                width: 0;
                height: 0;
                border-top: 13px solid transparent;
                border-bottom: 14px solid transparent;
                border-left: 10px solid rgb(173, 173, 173);
                position: absolute;
                top: 50%;
                margin-top: -14px;
                margin-left: 1px;
                left: 100%;
                z-index: 3;
            }

            /** The Spacing **/
            .btn-breadcrumb .btn {padding:6px 12px 6px 24px;}
            .btn-breadcrumb .btn:first-child {padding:6px 6px 6px 10px;}
            .btn-breadcrumb .btn:last-child {padding:6px 18px 6px 24px;}

            /** Default button **/
            .btn-breadcrumb .btn.btn-default:after { border-left: 10px solid #fff;}
            .btn-breadcrumb .btn.btn-default:hover:after {border-left: 10px solid #e6e6e6;}
            .btn-breadcrumb .btn.btn-default:hover:before, .btn-breadcrumb .btn.btn-default:before {border-left: 10px solid #adadad;}
            .breadcrumb-default{ border: solid 1px #adadad; }

            /** Primary button **/
            .btn-breadcrumb .btn.btn-primary:after {border-left: 10px solid #337ab7;}
            .btn-breadcrumb .btn.btn-primary:hover:after {border-left: 10px solid #286090;}
            .btn-breadcrumb .btn.btn-primary:hover:before, .btn-breadcrumb .btn.btn-primary:before {border-left: 10px solid #204d74;}
            .breadcrumb-primary{ border: solid 1px #204d74; }

            /** Success button **/
            .btn-breadcrumb .btn.btn-success:after {border-left: 10px solid #5cb85c;}
            .btn-breadcrumb .btn.btn-success:hover:after {border-left: 10px solid #449d44;}
            .btn-breadcrumb .btn.btn-success:hover:before, .btn-breadcrumb .btn.btn-success:before {border-left: 10px solid #398439;}
            .breadcrumb-success{ border: solid 1px #398439; }

            /** Danger button **/
            .btn-breadcrumb .btn.btn-danger:after {border-left: 10px solid #d9534f;}
            .btn-breadcrumb .btn.btn-danger:hover:after {border-left: 10px solid #c9302c;}
            .btn-breadcrumb .btn.btn-danger:hover:before, .btn-breadcrumb .btn.btn-danger:before {border-left: 10px solid #ac2925;}
            .breadcrumb-danger{ border: solid 1px #ac2925; }

            /** Warning button **/
            .btn-breadcrumb .btn.btn-warning:after {border-left: 10px solid #f0ad4e;}
            .btn-breadcrumb .btn.btn-warning:hover:after {border-left: 10px solid #ec971f;}
            .btn-breadcrumb .btn.btn-warning:hover:before, .btn-breadcrumb .btn.btn-warning:before {border-left: 10px solid #d58512;}
            .breadcrumb-warning{ border: solid 1px #d58512; }

            /** Info button **/
            .btn-breadcrumb .btn.btn-info:after {border-left: 10px solid #5bc0de;}
            .btn-breadcrumb .btn.btn-info:hover:after {border-left: 10px solid #31b0d5;}
            .btn-breadcrumb .btn.btn-info:hover:before, .btn-breadcrumb .btn.btn-info:before {border-left: 10px solid #269abc;}
            .breadcrumb-info{ border: solid 1px #269abc; }
        </style>
    @endpush
    @section('cabezera-contenido')
        <a href="{{url('proyectos')}}" class="btn btn-primary float-right">Atras</a>
        <h1>{{$proyecto->nombre }}</h1>
    @endsection
    <div class="content-fluid">
        <div>
            <ul class="nav nav-pills" wire:ignore.self>
                <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">Principal</a></li>
                <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Actividades({{$comentarios->count()}})</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Cotizaciones({{$cotizaciones->count()}})</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Archivos({{$archivos->count()}})</a></li>
            </ul>
            <div class="tab-content mt-3" wire:ignore.self>
                <div class="active tab-pane" id="general">
                    <div class="row"    >
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Presupuesto Estimado</span>
                                                    <span class="info-box-number text-center text-muted mb-0">S/ {{$proyecto->ingreso_estimado}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Gasto Estimado</span>
                                                    <span class="info-box-number text-center text-muted mb-0">S/ {{$proyecto->gasto_estimado}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Duracion Estimada</span>
                                                    <span class="info-box-number text-center text-muted mb-0">{{$proyecto->fecha_dia}} días</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="btn-group btn-breadcrumb breadcrumb-default">
                                        @foreach($etapas as $etapa)
                                            <a href="javascript:void(0)" class="btn {{ $etapa->nombre == $proyecto->etapa->nombre ? 'btn-info' : 'btn-default'}}" wire:click="cambiarEtapa({{ $etapa->id }})">{{$etapa->nombre}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="activity">
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
                                            <b class="d-block">{{$proyecto->lider->name}}</b>
                                        </p>
                                        <p class="text-sm">Equipo Proyecto <a href="javascript:void(0)" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#theModalEquipo"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            @if($proyecto->colaboradores)
                                                @foreach($proyecto->colaboradores as $t)
                                                    <b class="d-block">{{$t->usuario->name}} <a href="javascript:void(0)" wire:click="borrarColaborador({{$t}})"><i class="far fa-trash-alt"></i></a></b>
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
                                    <a href="{{route('cotizacion.create',$proyecto)}}" class="btn btn-sm btn-success float-right">Agregar Cotizacion</a>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th class="text-center">Codigo</th>
                                            <th class="text-center">Cliente</th>
                                            <th class="text-center">Fecha Inicio</th>
                                            <th class="text-center">Fecha Fin</th>
                                            <th class="text-center">Importe</th>
                                            <th class="text-center">Fecha Actualizado</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($cotizaciones as $cotizacion)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td class="text-center">{{$cotizacion->codigo}}</td>
                                                <td class="text-center"> {{$cotizacion->cliente->razon_social}}</td>
                                                <td class="text-center"> {{$cotizacion->fecha_inicio}}</td>
                                                <td class="text-center"> {{$cotizacion->fecha_fin}}</td>
                                                <td class="text-center">S/ {{ $cotizacion->total }}</td>
                                                <td class="text-center">{{$cotizacion->updated_at->diffForHumans()}}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('cotizacion.show',$cotizacion) }}" class="btn btn-success btn-sm"><i class="far fa-eye"></i></a>
                                                    <a href="{{ route('cotizacion.edit', $cotizacion) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="javascript:void(0)" onclick="Confirmar('{{ $cotizacion->id }}')" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                                    <a href="javascript:void(0)" onclick="Confirmacion('{{ $cotizacion->id }}')" class="btn btn-info btn-sm"><i class="fas fa-clipboard-check"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><p class="text-danger">0 Cotizaciones</p></tr>
                                        @endforelse
                                        </tbody>
                                    </table>
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
        <div class="modal fade" id="theModalEquipo" tabindex="-1" aria-labelledby="theModalEquipo" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="theModal">Agregar colaborador</h5>
                    </div>
                    <form wire:submit.prevent="createEquipo">
                        <div class="modal-body">
                            <div class="col-sm-12 col-md-12">
                                <div wire:ignore class="form-group">
                                    <label>Equipo</label>
                                    <select wire:model.defer="team" data-placeholder="Selecciona tu equipo" class="form-control">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('team') <span class="text-danger er">{{ $message }}</span>@enderror
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
            });
            window.livewire.on('proyecto-updated', msg =>{
                $('#theModal').modal('hide');
            });
            window.livewire.on('cerrar-modal', msg =>{
                $('#theModalEquipo').modal('hide');
            });
            window.livewire.on('comentario-added', msg =>{
                $('#theModalComentario').modal('hide');
            });
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
        function Confirmar(id)
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
                    window.livewire.emit('delete', id)
                    swal.close()
                }
            })
        }
        function Confirmacion(id)
        {
            Swal.fire({
                title: 'CONFIRMAR',
                text: "¿CONFIRMAS CREAR EL PEDIDO?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if(result.value){
                    window.livewire.emit('create', id)
                    swal.close()
                }
            })
        }
    </script>
</div>
