<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">
                        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
                        <h1>Lista de Clasificaciones</h1>
                    </h1>
                </div>
            </div>
        </div>
    </div>
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
                        <th class="text-center">NOMBRE</th>
                        <th class="text-center">ESTADO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clasificacions as $clasificacion)
                        <tr>
                            <th scope="row">{{$clasificacion->id}}</th>
                            <td class="text-center">{{$clasificacion->nombre}}</td>
                            <td class="text-center"><span class="badge {{ $clasificacion->estado == 'ACTIVO' ? 'badge-success' : 'badge-danger'}}">{{$clasificacion->estado}}</span></td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $clasificacion->id }})" class="btn btn-primary" title="Edit">
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $clasificacion->id }}')" class="btn btn-danger" title="Delet">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3">
                {{$clasificacions->links()}}
                </div>
            </div>
        </div>
        @include('livewire.clasificacions.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){

            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('clasificacion-added', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('clasificacion-updated', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('clasificacion-deleted', msg =>{
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

