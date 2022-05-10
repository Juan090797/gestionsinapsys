<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Marcas</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-body table-responsive">
                <table id="tabla" class="table compact hover stripe">
                    <thead class="thead-dark">
                        <tr>
                            <th>#ID</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($marcas as $marca)
                        <tr>
                            <th>{{$marca->id}}</th>
                            <td class="text-center">{{$marca->nombre}}</td>
                            <td class="text-center"><span class="badge {{ $marca->estado == 'ACTIVO' ? 'badge-success' : 'badge-danger'}}">{{$marca->estado}}</span></td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $marca->id }})" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $marca->id }}')" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('livewire.marcas.form')
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

