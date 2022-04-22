<div>
    @section('cabezera-contenido')
        <a href="{{ route('pedidos') }}" class="btn btn-primary float-right">Atras</a>
        <h1>Pedido {{$pedido->codigo}}</h1>
    @endsection
    <div class="content-fluid">
        <div class="row">
            <div class="col-sm-8 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <a href="javascript:void(0)" wire:click="crearCronogramaGarantia({{ $pedido }})" class="btn btn-primary float-right ml-3">Generar Garantia</a>
                        <a href="javascript:void(0)" wire:click="crearInstalacion({{ $pedido }})" class="btn btn-info float-right">Generar Entrega e Instalacion</a>
                        <h4 class="text-primary">Detalle del pedido</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4">
                                        <h5 class="text-bold">Cliente:</h5>
                                        <p>
                                            <b>Ruc:</b> {{$pedido->cliente->ruc}}<br>
                                            <b>Razon social:</b> {{$pedido->cliente->razon_social}}<br>
                                            <b>Direccion:</b> {{$pedido->cliente->direccion}}<br>
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        <h5 class="text-bold">Pedido:</h5>
                                        <p>
                                            <b>Codigo:</b> {{ $pedido->codigo }}<br>
                                            <b>Atendido:</b> {{ $pedido->atendido }}<br>
                                            <b>Vendedor:</b> {{ $pedido->user->name }}<br>
                                            <b>Fecha:</b> {{ date('d-m-Y', strtotime( $pedido->created_at ))}}<br>
                                        </p>
                                    </div>
                                    <div class="col-5">
                                        <p>
                                            <b>Plazo de entrega:</b> {{ $pedido->plazo_entrega }} días {{$pedido->txt_plazo}}<br>
                                            <b>Garantia:</b> {{ $pedido->garantia }} meses {{$pedido->txt_garantia}}<br>
                                            <b>Lugar de entrega:</b> {{ $pedido->direccion_entrega }}<br>
                                            <b>#Mantenimientos:</b> {{ $pedido->num_mantenimiento }}<br>
                                            <b>txt mantenimiento:</b> {{ $pedido->txt_mantenimiento }}<br>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <h5 class="text-bold">Productos:</h5>
                                    <table class="table table-sm table-hover">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th class="text-center">Producto</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">P. Unitario</th>
                                            <th class="text-center">P. total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pedido->pedidoDetalle as $index => $detalle)
                                            <tr>
                                                <th scope="row">{{$index + 1}}</th>
                                                <td class="text-center">{{ $detalle->producto->nombre }}</td>
                                                <td class="text-center">{{ $detalle->cantidad }}</td>
                                                <td class="text-center">S/ {{ number_format($detalle->precio_u,2) }}</td>
                                                <td class="text-center">S/ {{ number_format($detalle->precio_t,2) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-8">
                                                <h4>Actividades Recientes</h4>
                                            </div>
                                            <div class="col-4">
                                                <a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#theModalComentario">comentar</a>
                                            </div>
                                        </div>
                                        <div style="overflow-x: hidden; overflow-y: auto;">
                                            @foreach($comentarios as $comentario)
                                            <div class="post">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm" src="{{ $comentario->user->profile_photo_url }}">
                                                    <span class="username"><a href="#">{{$comentario->user->name}}</a></span>
                                                    <span class="description">{{ $comentario->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p>{{ $comentario->contenido }}</p>
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
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-success float-right" data-toggle="modal" data-target="#theModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        <h4 class="text-primary">Documentos</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="text-bold">Contratos</h5>
                        <ul class="list-unstyled">
                            @foreach($files as $file)
                                @if($file->tipo_documento == 'CONTRATO')
                                    <li>
                                        <a href="javascript:void(0)" wire:click="descargarArchivo({{ $file->id }})" class="btn-link text-secondary"><i class="fa fa-file-text-o" aria-hidden="true"></i> {{ $file->archivo }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <h5 class="text-bold">Orden compra</h5>
                        <ul class="list-unstyled">
                            @foreach($files as $file)
                                @if($file->tipo_documento == 'ORDEN COMPRA')
                                    <li>
                                        <a href="javascript:void(0)" wire:click="descargarArchivo({{ $file->id }})" class="btn-link text-secondary"><i class="fa fa-file-text-o" aria-hidden="true"></i> {{ $file->archivo }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <h5 class="text-bold">Guia remision</h5>
                        <ul class="list-unstyled">
                            @foreach($files as $file)
                                @if($file->tipo_documento == 'GUIA REMISION')
                                    <li>
                                        <a href="javascript:void(0)" wire:click="descargarArchivo({{ $file->id }})" class="btn-link text-secondary"><i class="fa fa-file-text-o" aria-hidden="true"></i> {{ $file->archivo }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <h5 class="text-bold">Facturas</h5>
                        <ul class="list-unstyled">
                            @foreach($files as $file)
                                @if($file->tipo_documento == 'FACTURA')
                                    <li>
                                        <a href="javascript:void(0)" wire:click="descargarArchivo({{ $file->id }})" class="btn-link text-secondary"><i class="fa fa-file-text-o" aria-hidden="true"></i> {{ $file->archivo }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
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
                    <form wire:submit.prevent="agregarArchivo">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <select class="form-control" wire:model.defer="tipo">
                                            <option value="" selected>Tipo documento</option>
                                            <option value="ORDEN COMPRA">Orden compra</option>
                                            <option value="GUIA REMISION">Guia remision</option>
                                            <option value="FACTURA">Factura</option>
                                            <option value="CONTRATO">Contrato</option>
                                        </select>
                                    </div>
                                    @error('tipo') <span class="text-danger er">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-8">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" wire:model="archivo_p">
                                            <label class="custom-file-label">{{ $archivo_p }}</label>
                                        </div>
                                    </div>
                                    @error('archivo_p') <span class="text-danger er">{{ $message }}</span>@enderror
                                    <div wire:loading wire:target="archivo_p">Cargando.....</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetUI()">Cerrar</button>
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
            window.livewire.on('comentario-added', msg =>{
                $('#theModalComentario').modal('hide');
            })
            window.livewire.on('archivo-added', msg =>{
                $('#theModal').modal('hide');
            })
            window.livewire.on('movimiento-updated', msg =>{
                $('#theModal').modal('hide');
            })
            window.livewire.on('movimiento-deleted', msg =>{
                noty(msg)
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

