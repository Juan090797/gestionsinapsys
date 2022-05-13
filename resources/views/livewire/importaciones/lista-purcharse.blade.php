<div>
    @section('cabezera-contenido')
        <a href="{{route('purchase.create')}}" class="btn btn-primary float-right">Agregar</a>
        <h1>Lista de Purchase Orders</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-body table-responsive">
                <table id="tabla" class="table compact hover stripe">
                    <thead class="thead-dark">
                    <tr>
                        <th>#ID</th>
                        <th class="text-center">Codigo</th>
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ordenes as $orden)
                        <tr>
                            <th>{{$orden->id}}</th>
                            <td class="text-center">{{$orden->codigo}}</td>
                            <td class="text-center">{{$orden->proveedor->razon_social}}</td>
                            <td class="text-center">{{$orden->fecha}}</td>
                            <td class="text-center">
                                <a href="{{route('purchase.show', $orden)}}" class="btn btn-primary btn-sm"><i class="far fa-eye" aria-hidden="true"></i></a>
                                <a href="{{route('costo.show', $orden)}}" class="btn btn-secondary btn-sm"><i class="fa fa-cog" aria-hidden="true"></i></a>
                                <a href="{{route('costo.create', $orden)}}" class="btn btn-success btn-sm"><i class="fa fa-align-justify" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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

