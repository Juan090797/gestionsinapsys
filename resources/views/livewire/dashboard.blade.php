<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">
                        <h1>Resumen</h1>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info" wire:click="cliente"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Clientes</span>
                        <span class="info-box-number">{{count($clientes)}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success" wire:click="producto"><i class="fa fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Productos</span>
                        <span class="info-box-number">{{count($productos)}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa fa-phone"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Contactos</span>
                        <span class="info-box-number">{{count($contactos)}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger" wire:click="proyecto"><i class="fa fa-briefcase"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Proyectos</span>
                        <span class="info-box-number">{{count($proyectos)}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
