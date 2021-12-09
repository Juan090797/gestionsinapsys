<div>
    @section('cabezera-contenido')
        <a href="{{url('proyectos')}}" class="btn btn-primary float-right">Atras</a>
        <h1>{{$proyecto->nombre }}</h1>
    @endsection
    <div class="content-fluid">
    <!--<div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Tareas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
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
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2>El proyecto se encuentra sin tareas</h2>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget
                        condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum,
                        mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat
                        massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel
                        metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor.
                        Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat
                        urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea
                        dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                </div>
            </div>
        </div>-->
    <!--<div class="card">
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
                            <div class="col-12">
                                <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">Tareas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-content-above-messages-tab" data-toggle="pill" href="#custom-content-above-messages" role="tab" aria-controls="custom-content-above-messages" aria-selected="false">Messages</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-content-above-settings-tab" data-toggle="pill" href="#custom-content-above-settings" role="tab" aria-controls="custom-content-above-settings" aria-selected="false">Settings</a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-3" id="custom-content-above-tabContent">
                                    <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
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
                                    <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis.
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet
                                        ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                                    </div>
                                    <div class="tab-pane fade" id="custom-content-above-messages" role="tabpanel" aria-labelledby="custom-content-above-messages-tab">
                                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa
                                        eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum,
                                        mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat
                                        massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel
                                        metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                                    </div>
                                    <div class="tab-pane fade" id="custom-content-above-settings" role="tabpanel" aria-labelledby="custom-content-above-settings-tab">
                                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor.
                                        Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat
                                        urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse
                                        platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                                    </div>
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
                                    <div  style="overflow-x: hidden; overflow-y: auto;">
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
                <!-- /.tab-pane -->
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
                <!-- /.tab-pane -->
            </div>

        </div>

    <!--<div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Actividades</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row">
                                        <div class="col-8">
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
                                        <div class="col-4">
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
                                                <div class="col-12">
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
                                                <div class="col-12">
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
                                <div class="tab-pane" id="timeline">
                                </div>
                                <div class="tab-pane" id="settings">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
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
