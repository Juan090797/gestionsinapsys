<div>
    <div class="card">
        <div class="card-header">
            <a>Contactos</a>
            <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#theModal">Agregar Contacto</a>
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Area</th>
                    <th scope="col">Cargo</th>
                    <th colspan="2">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @if(count($contactos))
                    @foreach($contactos as $contacto)
                        <tr>
                            <td>{{$contacto->nombre}}</td>
                            <td>{{$contacto->celular_cont}}</td>
                            <td>{{$contacto->correo_cont}}</td>
                            <td>{{$contacto->area_cont}}</td>
                            <td>{{$contacto->cargo_cont}}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="javascript:void(0)"  wire:click="Edit({{ $contacto->id }})">
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                                <a type="submit" class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="Confirm('{{ $contacto->id }}')">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr><th>No hay contactos</th></tr>
                @endif
                </tbody>
            </table>
        </div>
        @include('livewire.contactos.form')
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
