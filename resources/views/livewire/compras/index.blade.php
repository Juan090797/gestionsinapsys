<div>
    @section('cabezera-contenido')
        <a href="{{route('compracreate')}}" class="btn btn-primary float-right">Agregar</a>
        <h1>Lista de Compras</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4">
                        <input wire:model="search" class="form-control" placeholder="Buscar por nombre">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Tipo Docum.</th>
                        <th class="text-center">N° Documento</th>
                        <th class="text-center">IGV</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($compras as $index => $compra)
                        <tr>
                            <th scope="row">{{$compras->firstItem() + $index}}</th>
                            <td class="text-center">{{$compra->proveedor->razon_social}}</td>
                            <td class="text-center">{{$compra->created_at}}</td>
                            <td class="text-center"><span class="badge {{ $compra->tipo_documento == 'FACTURA' ? 'badge-success' : 'badge-danger'}}">{{$compra->tipo_documento}}</span></td>
                            <td class="text-center">{{$compra->numero_documento}}</td>
                            <td class="text-center">S/ {{$compra->impuesto}}</td>
                            <td class="text-center">S/ {{$compra->total}}</td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $compra->id }})" class="btn btn-primary" title="Editar">
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
                <div class="py-3">
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
