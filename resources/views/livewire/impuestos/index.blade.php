<div>
    @section('cabezera-contenido')
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Impuestos</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Valor</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($impuestos as $index => $impuesto)
                        <tr>
                            <th scope="row">{{$impuestos->firstItem() + $index}}</th>
                            <td class="text-center">{{$impuesto->nombre}}</td>
                            <td class="text-center">{{$impuesto->valor}}</td>
                            <td class="text-center"><span class="badge {{ $impuesto->estado == 'ACTIVO' ? 'badge-success' : 'badge-danger'}}">{{$impuesto->estado}}</span></td>
                            <td class="text-center">
                                <a href="javascript:void(0)"  wire:click="Edit({{ $impuesto->id }})" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">
                    {{$impuestos->links()}}
                </div>
            </div>
        </div>
        @include('livewire.impuestos.form')
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

