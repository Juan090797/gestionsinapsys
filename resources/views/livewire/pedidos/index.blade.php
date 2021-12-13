<div>
    @section('cabezera-contenido')
        <h1>Lista de Pedidos</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <input wire:model="search" class="form-control" placeholder="Buscar por cliente o N° Pedido">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-secondary uppercase mr-1" type="button" wire:click="AbrirOrdenCompra()">
                            + OC
                        </button>
                        <button class="btn btn-warning uppercase mr-1" type="button" wire:click="AbrirGuia()">
                            + GUIA
                        </button>
                        <button class="btn btn-info uppercase mr-1" type="button" wire:click="Despachar()">
                            DESPACHAR
                        </button>
                        <button class="btn btn-primary uppercase mr-1" type="button" wire:click="Facturar()">
                            FACTURAR
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th scope="col">ESTADO</th>
                        <th></th>
                        <th class="text-center">FECHA</th>
                        <th class="text-center">N°PEDIDO</th>
                        <th class="text-center">CLIENTE</th>
                        <th class="text-center">IMPORTE</th>
                        <th class="text-center">TIPO</th>
                        <th class="text-center">N°DOCUMENTO</th>
                        <th class="text-center">F.EMISION</th>
                        <th class="text-center">GUIA</th>
                        <th class="text-center">Ord.Compr.</th>
                        <th class="text-center">F.ENTREGA</th>
                        <th class="text-center">VENDEDOR</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <th><input type="checkbox" wire:model="selectedProducts" value="{{ $pedido->id }}"></th>
                            <th scope="row">
                                <span class="badge badge-success">{{$pedido->estado}}</span>
                            </th>
                            <th><i class="fas fa-truck"></i><i class="fas fa-check-circle"></i><i class="fas fa-flag"></i></th>
                            <th class="text-center">{{$pedido->created_at}}</th>
                            <td class="text-center">{{$pedido->codigo}}</td>
                            <td class="text-center">{{$pedido->cliente->razon_social}}</td>
                            <td class="text-center">S/ {{$pedido->total}}</td>
                            <td class="text-center"><span class="badge badge-success">FAC</span></td>
                            <td class="text-center">F001-0000048</td>
                            <td class="text-center">10-12-2021</td>
                            <td class="text-center">
                                <a href="javascript:void(0)" wire:click="descargaGuia({{ $pedido->id }})">{{$pedido->guiaremision}}</a>
                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0)" wire:click="descargaOc({{ $pedido->id }})">{{$pedido->ordencompra}}</a>
                            </td>
                            <td class="text-center">{{$pedido->fecha_entrega}}</td>
                            <td class="text-center">{{$pedido->user->name}}</td>
                            <td class="text-center">
                                <a href="#" class="btn-link text-secondary"><i class="far fa-eye"></i></a>
                                <a href="#" class="btn-link text-secondary"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" onclick="Confirmar('{{ $pedido->id }}')" class="btn-link text-secondary"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3">
                </div>
            </div>
        </div>
        <div class="modal fade" id="theModalOc" tabindex="-1" aria-labelledby="theModalOc" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="theModal">Agregar Orden de Compra(OC) Pedido #{{$numeroPedido}}</h5>
                    </div>
                    <form wire:submit.prevent="AgregarOrdenCompra">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="fechaplazo">Fecha plazo de entrega</label>
                                <input type="date" class="form-control" id="fechaplazo" wire:model="fechaplazo">
                            </div>
                            @error('fechaplazo') <span class="text-danger er">{{ $message }}</span>@enderror
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" wire:model="ordencompra">
                                    <label class="custom-file-label">{{$ordencompra}}</label>
                                </div>
                            </div>
                            @error('ordencompra') <span class="text-danger er">{{ $message }}</span>@enderror
                            <div wire:loading wire:target="ordencompra">Cargando.....</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click.prevent="resetUI()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="theModalG" tabindex="-1" aria-labelledby="theModalG" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="theModal">Agregar Guia de Remision(G) Pedido #{{$numeroPedido}}</h5>
                    </div>
                    <form wire:submit.prevent="AgregarGuia">
                        <div class="modal-body">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" wire:model="guia">
                                    <label class="custom-file-label">{{$guia}}</label>
                                </div>
                            </div>
                            @error('guia') <span class="text-danger er">{{ $message }}</span>@enderror
                            <div wire:loading wire:target="guia">Cargando.....</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click.prevent="resetUI()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
            window.Livewire.on('show-modal-oc', msg =>{
                $('#theModalOc').modal('show')
            });
            window.livewire.on('oc-added', msg =>{
                $('#theModalOc').modal('hide');
                noty(msg)
            });
            window.livewire.on('error-oc', msg =>{
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
            window.livewire.on('error-guia', msg =>{
                $('#theModalG').modal('hide');
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
    </script>
</div>
