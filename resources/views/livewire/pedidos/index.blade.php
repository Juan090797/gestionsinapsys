<div>
    @section('cabezera-contenido')
        <a href="{{route('pedido.create')}}" class="btn btn-primary float-right">Agregar</a>
        <h1>Lista de Pedidos</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-sm-12 col-md-4 col-xs-12">
                        <a href="javascript:void(0)" class="btn btn-sm btn-warning" wire:click="Despachar()">DESPACHAR</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-dark" wire:click="Facturar()">FACTURAR</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary" wire:click="Completar()">COMPLETADO</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-info" wire:click="Finalizar()">FINALIZADO</a>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xs-12">
                        <div class="btn-group float-right">
                            <button wire:click="filtroProyectosEstados" type="button" class="btn {{ is_null($status) ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">TODOS</span>
                                <span class="badge badge-pill badge-light">{{ $pedidosCount }}</span>
                            </button>
                            <button wire:click="filtroProyectosEstados('EN PROCESO')" type="button" class="btn {{ ($status === 'EN PROCESO') ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">EN PROCESO</span>
                                <span class="badge badge-pill badge-success">{{ $proyectosProcesosCount }}</span>
                            </button>
                            <button wire:click="filtroProyectosEstados('FACTURADO')" type="button" class="btn {{ ($status === 'FACTURADO') ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">FACTURADO</span>
                                <span class="badge badge-pill badge-dark">{{ $proyectosFacturadosCount }}</span>
                            </button>
                            <button wire:click="filtroProyectosEstados('DESPACHADO')" type="button" class="btn {{ ($status === 'DESPACHADO') ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">DESPACHADOS</span>
                                <span class="badge badge-pill badge-warning">{{ $proyectosDespachadosCount }}</span>
                            </button>
                            <button wire:click="filtroProyectosEstados('COMPLETADO')" type="button" class="btn {{ ($status === 'COMPLETADO') ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">COMPLETADOS</span>
                                <span class="badge badge-pill badge-primary">{{ $proyectosCompletadosCount }}</span>
                            </button>
                            <button wire:click="filtroProyectosEstados('FINALIZADO')" type="button" class="btn {{ ($status === 'FINALIZADO') ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">FINALIZADOS</span>
                                <span class="badge badge-pill badge-info">{{ $proyectosFinalizadosCount }}</span>
                            </button>
                            <button wire:click="filtroProyectosEstados('ANULADO')" type="button" class="btn {{ ($status === 'ANULADO') ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">ANULADOS</span>
                                <span class="badge badge-pill badge-danger">{{ $proyectosAnuladosCount }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">N°Pedido</th>
                        <th class="text-center">Fecha pedido</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Importe</th>
                        <th class="text-center">Vendedor</th>
                        <th class="text-center">Actualizado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <th scope="row">
                                @if($pedido->estado == 'FINALIZADO' || $pedido->estado == 'ANULADO')
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $pedido->id }}" disabled>
                                @else
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $pedido->id }}">
                                @endif
                            </th>
                            <th class="text-center"><span class="badge {{$pedido->estado_badge}}">{{$pedido->estado}}</span></th>
                            <td class="text-center">{{ $pedido->codigo }}</td>
                            <th class="text-center">{{ $pedido->formate_fecha }}</th>
                            <td class="text-center">{{ $pedido->cliente->razon_social }}</td>
                            <td class="text-center">S/ {{ $pedido->total }}</td>
                            <td class="text-center">{{ $pedido->user->name }}</td>
                            <td class="text-center">{{ $pedido->updated_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <a href="javascript:void(0)" wire:click="verPedido('{{ $pedido->id }}')" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{route('pedido.show', $pedido)}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{route('pedido.edit', $pedido)}}" class="btn btn-warning btn-sm" {{ $pedido->estado_disabled }}><i class="fas fa-pencil-alt"></i></a>
                                <button href="javascript:void(0)" onclick="Confirm('{{ $pedido->id }}')" class="btn btn-danger btn-sm" {{ $pedido->estado_disabled }}><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">
                </div>
            </div>
        </div>
        @if($ped)
            <div class="modal fade" id="theModalPedido" tabindex="-1" aria-labelledby="theModalPedido" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="theModal">Pedido #{{$ped->codigo}} </h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="cliente">Cliente:</label>
                                        <input type="text" class="form-control" id="cliente" value="{{$ped->cliente->razon_social}}" disabled>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="total">Vendedor:</label>
                                        <input type="text" class="form-control" id="total" value="{{$ped->user->name}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Codigo</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ped->pedidoDetalle as $p)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="text-left">{{$p->producto->nombre}}</td>
                                            <th class="text-left">{{$p->producto->codigo}}</th>
                                            <td class="text-center">{{$p->cantidad}}</td>
                                            <td class="text-center">S/ {{$p->precio_u}}</td>
                                            <td class="text-center">S/ {{$p->precio_t}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">SubTotal:</td>
                                                <td class="text-center">S/ {{$ped->total}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Impuesto:</td>
                                                <td class="text-center">S/ {{$ped->impuesto}}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Total:</td>
                                                <td class="text-center">S/ {{$ped->total}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click.prevent="resetUI()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.Livewire.on('show-modal-pedido', msg =>{
                $('#theModalPedido').modal('show')
            });
        });
        function Confirm(id)
        {
            Swal.fire({
                title: 'CONFIRMAR',
                text: "¿CONFIRMAS ANULAR EL PEDIDO?",
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
