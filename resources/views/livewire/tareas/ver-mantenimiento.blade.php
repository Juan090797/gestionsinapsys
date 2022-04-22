<div>
    @section('cabezera-contenido')
        <a href="{{route('tareas')}}" class="btn btn-primary float-right">Atras</a>
        <h1>Mantenimiento #{{'MANT000'.$mantenimiento->id}}</h1>
    @endsection
    <div class="content-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <p>
                                    <b>CLIENTE:</b> <br>
                                    Razon social: {{$mantenimiento->garantia->cliente->razon_social}}<br>
                                    Ruc: {{$mantenimiento->garantia->cliente->ruc}}<br>
                                    Telefono: {{$mantenimiento->garantia->cliente->telefono}}<br>
                                    Celular: {{$mantenimiento->garantia->cliente->celular}}<br>
                                    Direccion: {{$mantenimiento->garantia->cliente->direccion}}
                                </p>
                            </div>
                            <div class="col-4">
                                <p>
                                    <b>PRODUCTO:</b> <br>
                                    Nombre: {{$mantenimiento->garantia->producto->nombre}}<br>
                                    Marca: {{$mantenimiento->garantia->producto->marca->nombre}}<br>
                                    Modelo: {{$mantenimiento->garantia->producto->modelo}}<br>
                                    Serie: #SERIE
                                </p>
                            </div>
                            <div class="col-4">
                                <p>
                                    <b>MANTENIMIENTO:</b> <br>
                                    Fecha ejecucion: {{$mantenimiento->fecha_ejecucion}}<br>
                                    TECNICO: {{$mantenimiento->tecnico->name}}<br>
                                    Estado:<select class="form-control" style="width: 50%" wire:model="estado">
                                        <option value="ASIGNADO">ASIGNADO</option>
                                        <option value="EN PROCESO">EN PROCESO</option>
                                        <option value="TERMINADO">TERMINADO</option>
                                    </select>
                                </p>
                            </div>
                            <div class="col-12">
                                <label for="">NOTAS:</label>
                                <textarea cols="30" rows="5" class="form-control" disabled>{{$mantenimiento->notas}}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-8">
                                        <h4>Actividades Recientes</h4>
                                    </div>
                                    <div class="col-4">
                                        <a href="javascript:void(0)" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#theModalComentario">comentar</a>
                                    </div>
                                </div>
                                <div style="overflow-x: hidden; overflow-y: auto;">
                                    @foreach($comentarios as $comentario)
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="{{ $comentario->usuario->profile_photo_url }}">
                                                <span class="username"><a href="#">{{$comentario->usuario->name}}</a></span>
                                                <span class="description">{{ $comentario->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p>{{ $comentario->texto }}</p>
                                            @if($comentario->archivo)
                                                <p><a href="javascript:void(0)" wire:click="descargaArchivoComentario({{ $comentario->id }})" class="link-black text-sm"><i class="fas fa-link mr-1"></i> {{ $comentario->archivo }}</a></p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="theModalComentario" tabindex="-1" aria-labelledby="theModalComentario" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="theModal">Agregar comentario</h5>
                    </div>
                    <form wire:submit.prevent="createComentario">
                        <div class="modal-body">
                            <div class="form-group">
                                <textarea type="text" class="form-control" name="contenido" wire:model.defer="contenido" placeholder="Comentario"></textarea>
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" wire:model="archivo">
                                    <label class="custom-file-label">{{$archivo}}</label>
                                </div>
                            </div>
                            @error('archivo') <span class="text-danger er">{{ $message }}</span>@enderror
                            <div wire:loading wire:target="archivo">Cargando.....</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.livewire.on('hide-modal', msg =>{
                $('#theModalComentario').modal('hide');
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

