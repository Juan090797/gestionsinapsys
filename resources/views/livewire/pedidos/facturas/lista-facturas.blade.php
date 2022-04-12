<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de documentos ingresos</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="col-4">
                    <a class="btn btn-success" wire:click="exportFacturas()"><i class="fas fa-file-excel"></i> Excel</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Fecha Emision</th>
                        <th class="text-center">Fecha Pago</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Tipo documento</th>
                        <th class="text-center">Serie documento</th>
                        <th class="text-center">Numero documento</th>
                        <th class="text-center">Subtotal</th>
                        <th class="text-center">IGV</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($facturas as $factura)
                        <tr>
                            <th scope="row">{{ date('d-m-Y', strtotime($factura->fecha_emision)) }}</th>
                            <td class="text-center">{{ date('d-m-Y', strtotime($factura->fecha_pago)) }}</td>
                            <td class="text-center">{{ $factura->pedido->cliente->razon_social }}</td>
                            <td class="text-center"><span class="badge {{ $factura->documento->nombre == 'FACTURA' ? 'badge-success' : 'badge-danger'}}">{{ $factura->documento->nombre }}</span></td>
                            <td class="text-center">{{ $factura->serie_documento }}</td>
                            <td class="text-center">{{ $factura->numero_documento }}</td>
                            <td class="text-center">S/ {{ number_format($factura->subtotal,2) }}</td>
                            <td class="text-center">S/ {{ number_format($factura->igv,2) }}</td>
                            <td class="text-center">S/ {{ number_format($factura->total,2) }}</td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $factura->id }})" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="javascript:void(0)"  onclick="Confirm('{{ $factura->id }}')" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">

                </div>
            </div>
        </div>
        @include('livewire.pedidos.facturas.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('hide-modal', msg =>{
                $('#theModal').modal('hide');
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

