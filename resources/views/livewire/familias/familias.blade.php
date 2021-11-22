<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Tipo Equipos</h1>
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
                        <th class="text-center">NOMBRE</th>
                        <th class="text-center">ESTADO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($familias as $index => $familia)
                        <tr>
                            <th scope="row">{{$familias->firstItem() + $index}}</th>
                            <td class="text-center">{{$familia->nombre}}</td>
                            <td class="text-center"><span class="badge {{ $familia->estado == 'ACTIVO' ? 'badge-success' : 'badge-danger'}}">{{$familia->estado}}</span></td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $familia->id }})" class="btn btn-primary" title="Edit">
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $familia->id }}')" class="btn btn-danger" title="Delet">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3">
                {{$familias->links()}}
                </div>
            </div>
        </div>
        @include('livewire.familias.form')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){

            window.Livewire.on('show-modal', msg =>{
                $('#theModal').modal('show')
            });
            window.livewire.on('familia-added', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('familia-updated', msg =>{
                $('#theModal').modal('hide');
                noty(msg)
            })
            window.livewire.on('familia-deleted', msg =>{
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

