<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GrupoSinpasys</title>
    @include('layouts.tema.styles')
    @livewireStyles
    @stack('styles')

</head>
<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed text-sm">
<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
    </div>
    <!-- Navbar -->
    @include('layouts.tema.navbar')
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    @include('layouts.tema.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            @yield('cabezera-contenido')
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
    <!-- /.content-wrapper -->
    @include('layouts.tema.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('layouts.tema.scripts')
@livewireScripts
@stack('js')
</body>
</html>
