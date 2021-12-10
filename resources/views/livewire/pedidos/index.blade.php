<div>
    @section('cabezera-contenido')
        <!--<a href="{{route('pedidocreate')}}" class="btn btn-primary float-right">Agregar</a>-->
        <h1>Lista de Pedidos</h1>
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
                        <th scope="col">ESTADO</th>
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
                            <th scope="row">
                                <span class="badge badge-success">{{$pedido->estado}}</span>
                            </th>
                            <th class="text-center">{{$pedido->created_at}}</th>
                            <td class="text-center">{{$pedido->codigo}}</td>
                            <td class="text-center">{{$pedido->cliente->razon_social}}</td>
                            <td class="text-center">S/ {{$pedido->total}}</td>
                            <td class="text-center"><span class="badge badge-success">FAC</span></td>
                            <td class="text-center">F001-0000048</td>
                            <td class="text-center">10-12-2021</td>
                            <td class="text-center">
                                <a href="">guia.pdf</a>
                            </td>
                            <td class="text-center">
                                <a href="#">OC123456789</a>
                            </td>
                            <td class="text-center">10-12-2021</td>
                            <td class="text-center">{{$pedido->user->name}}</td>
                            <td class="text-center">
                                <a href="#" class="btn-link text-secondary"><i class="far fa-eye"></i></a>
                                <a href="#" class="btn-link text-secondary"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" onclick="Confirmar('{{ $pedido->id }}')" class="btn-link text-secondary"><i class="far fa-trash-alt"></i></a>
                                <a href="javascript:void(0)" onclick="Confirmacion('{{ $pedido->id }}')" class="btn-link text-secondary"><i class="fas fa-clipboard-check"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3">
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){

            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('categoria-added', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('categoria-updated', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('categoria-deleted', msg =>{
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
