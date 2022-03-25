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
                        <a class="btn btn-success" href="{{ route('compra.export') }}"><i class="fas fa-file-excel"></i> Excel</a>
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
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Fecha Documento</th>
                        <th class="text-center">Tipo Documento</th>
                        <th class="text-center">Serie Documento</th>
                        <th class="text-center">N° Documento</th>
                        <th class="text-center">IGV</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($compras as $compra)
                        <tr>
                            <th>
                                @if($compra->estado == 'APROBADO')
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $compra->id }}" disabled>
                                @else
                                    <input type="checkbox" wire:model="selectedProducts" value="{{ $compra->id }}">
                                @endif
                            </th>
                            <td class="text-center">{{ $compra->proveedor->razon_social }}</td>
                            <td class="text-center">{{ date('d-m-Y', strtotime($compra->fecha_documento)) }}</td>
                            <td class="text-center"><span class="badge {{ $compra->tipo_documento == 'Factura' ? 'badge-success' : 'badge-danger'}}">{{$compra->tipo_documento}}</span></td>
                            <td class="text-center">{{ $compra->serie_documento }}</td>
                            <td class="text-center">{{ $compra->numero_documento }}</td>
                            <td class="text-center">S/ {{ number_format($compra->impuesto,2) }}</td>
                            <td class="text-center">S/ {{ number_format($compra->total,2) }}</td>
                            <td class="text-center"><span class="badge {{ $compra->estado == 'APROBADO' ? 'badge-success' : 'badge-danger'}}">{{$compra->estado}}</span></td>
                            <td class="text-center">
                                <a href="{{route('compra.edit', $compra)}}" class="btn btn-primary" title="Editar">
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $compra->id }}')" class="btn btn-danger" title="Eliminar">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
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

