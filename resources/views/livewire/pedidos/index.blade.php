<div>
    @section('cabezera-contenido')
        <a href="{{route('pedido.create')}}" class="btn btn-primary float-right">Agregar</a>
        <h1>Lista de Pedidos</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                    </div>
                    <div class="col-4">
                    </div>
                    <div class="col-4">

                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Estado</th>
                        <th class="text-center">N°Pedido</th>
                        <th class="text-center">Fecha pedido</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Importe</th>
                        <th class="text-center">Vendedor</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <th scope="row">
                                @if($pedido->estado == 'Facturado')
                                    <span class="badge badge-primary">{{$pedido->estado}}</span>
                                @elseif($pedido->estado == 'Anulado')
                                    <span class="badge badge-danger">{{$pedido->estado}}</span>
                                @elseif($pedido->estado == 'Despachado')
                                    <span class="badge badge-info">{{$pedido->estado}}</span>
                                @else
                                    <span class="badge badge-success">{{$pedido->estado}}</span>
                                @endif
                            </th>
                            <td class="text-center">{{$pedido->codigo}}</td>
                            <th class="text-center">{{$pedido->formate_fecha}}</th>
                            <td class="text-center">{{$pedido->cliente->razon_social}}</td>
                            <td class="text-center">S/ {{$pedido->total}}</td>
                            <td class="text-center">{{$pedido->user->name}}</td>
                            <td class="text-center">
                                <a href="javascript:void(0)" wire:click="verPedido('{{ $pedido->id }}')" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                <a href="{{route('pedido.show', $pedido)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $pedido->id }}')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.Livewire.on('show-modal-oc', msg =>{
                $('#theModalOc').modal('show')
            });
            window.livewire.on('oc-added', msg =>{
                $('#theModalOc').modal('hide');
                noty(msg)
            });
            window.Livewire.on('show-modal-guia', msg =>{
                $('#theModalG').modal('show')
            });
            window.livewire.on('guia-added', msg =>{
                $('#theModalG').modal('hide');
                noty(msg)
            });
            window.livewire.on('error', msg =>{
                noty(msg)
            });
            window.Livewire.on('show-modal-factura', msg =>{
                $('#theModalFactura').modal('show')
            });
            window.livewire.on('factura-added', msg =>{
                $('#theModalFactura').modal('hide');
                noty(msg)
            });
            window.livewire.on('despachar', msg =>{
                noty(msg)
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
                if (result.isConfirmed) {
                    Swal.fire(
                        'Eliminado!',
                        'El registro ha sido eliminado',
                        'success'
                    )
                }
            })
        }
    </script>
</div>
