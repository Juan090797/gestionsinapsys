<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CorpSinapsys</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="{{ asset('estilos/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900|Raleway:400,300,700,900" rel="stylesheet">
    <!-- Bootstrap CSS File -->
    <link href="{{ asset('estilos/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Libraries CSS Files -->
    <link href="{{ asset('estilos/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Main Stylesheet File -->
    <link href="{{ asset('estilos/css/style.css') }}" rel="stylesheet">
</head>
<body data-spy="scroll" data-offset="80" data-target="#thenavbar">
<!-- Fixed navbar -->
<div id="thenavbar" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}"><i class="fa fa-bolt"></i></a>
        </div>
        <div class="navbar-collapse collapse">
            @if (Route::has('login'))
                <ul class="nav navbar-nav navbar-right">
                    @auth
                        <li><a href="{{ url('/dashboard') }}" >Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" >Ingresar</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" >Registrarte</a></li>
                        @endif
                    @endauth
                </ul>
            @endif
        </div>
        <!--/.nav-collapse -->
    </div>
</div>
<div id="hello">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 centered">
                <h1>Corporacion Sinapsys</h1>
                <h2>Sistema de Gestion</h2>
            </div>
            <!-- /col-lg-8 -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /hello -->
<!-- JavaScript Libraries -->
<script src="{{ asset('estilos/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('estilos/lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('estilos/lib/php-mail-form/validate.js') }}"></script>
<script src="{{ asset('estilos/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('estilos/lib/chart/chart.js') }}"></script>

<!-- Template Main Javascript File -->
<script src="{{ asset('estilos/js/main.js') }}"></script>

</body>
</html>
