<div>
    @section('cabezera-contenido')
        <a href="{{route('ingresoscreate')}}" class="btn btn-primary float-right">Agregar</a>
        <h1>Lista de guias de ingresos</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <a href="javascript:void(0)" class="btn btn-success" wire:click="AprobarMovimiento()">Aprobar</a>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <input wire:model="search" class="form-control" placeholder="Buscar por nombre">
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th class="text-center">Tipo Doc.</th>
                        <th class="text-center">N° Doc.</th>
                        <th class="text-center">Fecha ingreso</th>
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Tipo Doc. Refer.</th>
                        <th class="text-center">Doc. Referencia</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ingresos as $ingreso)
                        <tr>
                            <th>
                                @if($ingreso->estado == 'Aprobado')
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $ingreso->id }}" disabled>
                                @else
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $ingreso->id }}">
                                @endif
                            </th>
                            <td class="text-center">{{$ingreso->tipo_documento}}</td>
                            <td class="text-center">{{$ingreso->numero_guia}}</td>
                            <td class="text-center">{{$ingreso->created_at}}</td>
                            <td class="text-center">{{$ingreso->nombre_cliente}}</td>
                            <td class="text-center"><span class="badge badge-success">Factura</span></td>
                            <td class="text-center">{{$ingreso->referencia}}</td>
                            <td class="text-center"><span class="badge {{ $ingreso->estado == 'Aprobado' ? 'badge-success' : 'badge-danger'}}">{{$ingreso->estado}}</span></td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="verIngreso({{ $ingreso->id }})" class="btn btn-primary" title="Ver">
                                    <i class="far fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $ingreso->id }}')" class="btn btn-danger" title="Eliminar">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">
                    {{$ingresos->links()}}
                </div>
            </div>
        </div>
        @if($ped)
            <div class="modal fade" id="theModalPedido" tabindex="-1" aria-labelledby="theModalPedido" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="theModal">Guia de Ingreso #{{$ped->numero_guia}} </h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cliente">Cliente</label>
                                        <input type="text" class="form-control" id="cliente" value="{{$ingreso->nombre_cliente}}" disabled>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="cliente">Doc.Referencia</label>
                                        <input type="text" class="form-control" id="cliente" value="{{$ped->referencia}}" disabled>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="cliente">Fecha Ingreso</label>
                                        <input type="date" class="form-control" id="cliente" value="{{$ped->fecha_ingreso}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row table-responsive">
                                <table class="table table-sm">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Codigo</th>
                                        <th class="text-center">Marca</th>
                                        <th class="text-center">UM</th>
                                        <th class="text-center">Cantidad</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ped->movimientoDetalles as $p)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="text-center">{{$p->producto->nombre}}</td>
                                            <th class="text-center">{{$p->producto->codigo}}</th>
                                            <th class="text-center">{{$p->producto->marca->nombre}}</th>
                                            <td class="text-center">{{$p->producto->unidad->nombre}}</td>
                                            <td class="text-center">{{$p->cantidad}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <td class="text-right">Total items:</td>
                                                <td class="text-center"> {{$ped->total_items}}</td>
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

            window.Livewire.on('show-modal-ingreso', msg =>{
                $('#theModalPedido').modal('show')
            });

            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('marca-added', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('marca-updated', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('marca-deleted', msg =>{
                noty(msg)
            })
            window.livewire.on('error', msg =>{
                noty(msg)
            })
            window.livewire.on('aprobado', msg =>{
                noty(msg)
            })
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

