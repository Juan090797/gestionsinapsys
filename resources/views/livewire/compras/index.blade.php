<div>
    @section('cabezera-contenido')
        <a href="{{route('compracreate')}}" class="btn btn-primary float-right">Agregar</a>
        <h1>Lista de Compras</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-4">
                        <a href="javascript:void(0)" class="btn btn-primary" wire:click="AprobarMovimiento()">Aprobar</a>
                        <a class="btn btn-success" wire:click="exportCompras()"><i class="fas fa-file-excel"></i> Excel</a>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar por nombre del proveedor" wire:model="search">
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
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Fecha Emision</th>
                        <th class="text-center">Fecha Pago</th>
                        <th class="text-center">Tipo Documento</th>
                        <th class="text-center">Serie Documento</th>
                        <th class="text-center">N° Documento</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($compras as $compra)
                        <tr>
                            <th>
                                <input type="checkbox" wire:model="selectedProducts" value="{{ $compra->id }}" {{ $compra->estado_disabled }}>
                            </th>
                            <td class="text-center"><span class="badge {{ $compra->estado == 'APROBADO' ? 'badge-success' : 'badge-danger'}}">{{$compra->estado}}</span></td>
                            <td class="text-center">{{ $compra->proveedor->razon_social }}</td>
                            <td class="text-center">{{ date('d-m-Y', strtotime($compra->fecha_documento)) }}</td>
                            <td class="text-center">{{ date('d-m-Y', strtotime($compra->fecha_pago)) }}</td>
                            <td class="text-center"><span class="badge {{ $compra->documento->nombre == 'FACTURA' ? 'badge-success' : 'badge-danger'}}">{{$compra->documento->nombre}}</span></td>
                            <td class="text-center">{{ $compra->serie_documento }}</td>
                            <td class="text-center">{{ $compra->numero_documento }}</td>
                            <td class="text-center">S/ {{ number_format($compra->total,2) }}</td>
                            <td class="text-center">
                                <button href="{{route('compra.edit', $compra)}}" class="btn btn-warning btn-sm" title="Editar" {{ $compra->estado_disabled }}><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                                <button href="javascript:void(0)" onclick="Confirm('{{ $compra->id }}')" class="btn btn-danger btn-sm" title="Eliminar" {{ $compra->estado == 'ANULADO' ? 'disabled' : '' }}><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">
                    {{$compras->links()}}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
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
    </script>
</div>

