<div>
    @section('cabezera-contenido')
        @if(session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        @if(isset($errors) && $errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        @if(session()->has('failures'))
            <table class="table table-danger">
                <tr>
                    <th>Columna</th>
                    <th>Atributos</th>
                    <th>Error</th>
                    <th>Valor</th>
                </tr>
                @foreach(session()->get('failures') as $validation)
                    <tr>
                        <td>{{ $validation->row() }}</td>
                        <td>{{ $validation->attribute() }}</td>
                        <td>
                            <ul>
                                @foreach($validation->errors() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $validation->values()[$validation->attribute()]}}</td>
                    </tr>
                @endforeach
            </table>
        @endif
        <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target="#theModal">Agregar</a>
        <h1>Lista de Productos</h1>
    @endsection
    <div class="content-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <form method="post" action="{{url('productos/imports/')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="file" type="file" class="custom-file-input" required>
                                    <label name="file" id="file" class="custom-file-label">Seleccionar....</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Insertar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <a class="btn btn-success" href="{{ url('productos/exports/') }}"><i class="fas fa-file-excel"></i> Excel</a>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <input class="form-control" placeholder="Buscar por codigo, descripcion o nombre del producto" wire:model="search">
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-sm table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Codigo</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Clasificacion</th>
                        <th class="text-center">U.Medida</th>
                        <th class="text-center">Marca</th>
                        <th class="text-center">Modelo</th>
                        <th class="text-center">Precio Venta</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <th scope="row">{{$producto->codigo}}</th>
                            <td>{{$producto->nombre}}</td>
                            <td class="text-center">{{$producto->clasificacion->nombre}}</td>
                            <td class="text-center">{{$producto->unidad->nombre}}</td>
                            <td class="text-center">{{$producto->marca->nombre}}</td>
                            <td class="text-left">{{$producto->modelo}}</td>
                            <td class="text-center">S/ {{$producto->precio_venta}}</td>
                            <td class="text-left">{{$producto->tipo}}</td>
                            <td class="text-center"><span class="badge {{ $producto->stock > 0 ? 'badge-success' : 'badge-danger'}}">{{$producto->stock > 0 ? $producto->stock : 'sin stock' }}</span></td>
                            <td class="text-center">
                                <a href="javascript:void(0)" wire:click="Edit({{ $producto->id }})" class="btn btn-primary btn-sm" title="Editar"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                <a href="javascript:void(0)" onclick="Confirm('{{ $producto->id }}')" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="py-3 float-right">
                    {{$productos->links()}}
                </div>
            </div>
        </div>
        @include('livewire.productos.form')
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

