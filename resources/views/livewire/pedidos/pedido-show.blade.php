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
                                    <div class="col-4">
                                        <h5 class="text-bold">Pedido:</h5>
                                        <p>
                                            <b>Codigo:</b> {{$pedido->codigo}}<br>
                                            <b>Vendedor:</b> {{$pedido->user->name}}<br>
                                            <b>Fecha:</b> {{ date('d-m-Y', strtotime($pedido->created_at))}}<br>
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
                                            <div class="post">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                                    <span class="username">
                                                        <a href="#">Jonathan Burke Jr.</a>
                                                    </span>
                                                    <span class="description">Shared publicly - 7:45 PM today</span>
                                                </div>

                                                <p>
                                                    Lorem ipsum represents a long-held tradition for designers,
                                                    typographers and the like. Some people hate it and argue for
                                                    its demise, but others ignore.
                                                </p>
                                                <p>
                                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                                </p>
                                            </div>
                                            <div class="post">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                                    <span class="username">
                                                        <a href="#">Jonathan Burke Jr.</a>
                                                    </span>
                                                    <span class="description">Shared publicly - 7:45 PM today</span>
                                                </div>

                                                <p>
                                                    Lorem ipsum represents a long-held tradition for designers,
                                                    typographers and the like. Some people hate it and argue for
                                                    its demise, but others ignore.
                                                </p>
                                                <p>
                                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                                </p>
                                            </div>
                                            <div class="post">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                                    <span class="username">
                                                        <a href="#">Jonathan Burke Jr.</a>
                                                    </span>
                                                    <span class="description">Shared publicly - 7:45 PM today</span>
                                                </div>

                                                <p>
                                                    Lorem ipsum represents a long-held tradition for designers,
                                                    typographers and the like. Some people hate it and argue for
                                                    its demise, but others ignore.
                                                </p>
                                                <p>
                                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                                </p>
                                            </div>
                                            <div class="post">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                                    <span class="username">
                                                        <a href="#">Jonathan Burke Jr.</a>
                                                    </span>
                                                    <span class="description">Shared publicly - 7:45 PM today</span>
                                                </div>

                                                <p>
                                                    Lorem ipsum represents a long-held tradition for designers,
                                                    typographers and the like. Some people hate it and argue for
                                                    its demise, but others ignore.
                                                </p>
                                                <p>
                                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                                </p>
                                            </div>
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
                        <h5 class="text-bold">Orden compra:</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                            </li>
                        </ul>
                        <h5 class="text-bold">Guia remision:</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                            </li>
                        </ul>
                        <h5 class="text-bold">Facturas:</h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                            </li>
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
                    <form wire:submit.prevent="createArchivo">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <select wire:model.defer="state.prioridad" class="form-control">
                                            <option value="" selected>Tipo documento</option>
                                            <option value="ALTA">Orden compra</option>
                                            <option value="MEDIA">Guia remision</option>
                                            <option value="BAJA">Factura</option>
                                        </select>
                                    </div>
                                    @error('archivo') <span class="text-danger er">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-8">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" wire:model="archivo">
                                            <label class="custom-file-label"></label>
                                        </div>
                                    </div>
                                    @error('archivo') <span class="text-danger er">{{ $message }}</span>@enderror
                                    <div wire:loading wire:target="archivo">Cargando.....</div>
                                </div>
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
                                    <label class="custom-file-label"></label>
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
            window.livewire.on('movimiento-added', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
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

