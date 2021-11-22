<div>
    @section('cabezera-contenido')
        <h1>Configuracion de la Empresa</h1>
    @endsection
    <div class="content-fluid">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="header">

                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="updateEmpresa">
                            <div class="form-group">
                                <label for="nombre">Nombre de la empresa</label>
                                <input type="text" wire:model.defer="nombre" class="form-control" id="nombre" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="ruc">Ruc de la empresa</label>
                                <input type="text" wire:model.defer="ruc" class="form-control" id="ruc" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <input type="text" wire:model.defer="direccion" class="form-control" id="direccion">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Telefono</label>
                                <input type="text" wire:model.defer="telefono" class="form-control" id="telefono">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Celular</label>
                                <input type="text" wire:model.defer="celular" class="form-control" id="celular">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Correo</label>
                                <input type="email" wire:model.defer="correo" class="form-control" id="correo">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function (){
            window.livewire.on('empresa-ok', msg =>{
                noty(msg)
            })
        });
    </script>
</div>
