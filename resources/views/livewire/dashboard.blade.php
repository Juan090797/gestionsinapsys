<div>
    @push('styles')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    @endpush
    @section('cabezera-contenido')
        <h1>Resumen</h1>
    @endsection
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
            <div class="col-8">
                <canvas id="pie-chart"></canvas>
            </div>
        </div>
    </div>
        <script>
        </script>
</div>
