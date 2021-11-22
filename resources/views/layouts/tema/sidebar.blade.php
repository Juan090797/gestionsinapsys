<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">Grupo Sinapsys</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item {{ request()->is('dashboard') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Resumen</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Modulos</li>
                <li class="nav-item">
                    <a href="{{ url('proyectos') }}" class="nav-link {{ request()->is('proyectos') ? 'active' : '' }}">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>Proyectos</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('clientes') ? 'menu-open' : '' }} {{ request()->is('categorias') ? 'menu-open' : '' }} {{ request()->is('industrias') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('clientes') ? 'active' : '' }} {{ request()->is('categorias') ? 'active' : '' }} {{ request()->is('industrias') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Clientes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('clientes') }}" class="nav-link {{ request()->is('clientes') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('categorias') }}" class="nav-link {{ request()->is('categorias') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categorias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('industrias') }}" class="nav-link {{ request()->is('industrias') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Industria</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('productos') ? 'menu-open' : '' }} {{ request()->is('marcas') ? 'menu-open' : '' }} {{ request()->is('tipoequipos') ? 'menu-open' : '' }} {{ request()->is('clasificacions') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('productos') ? 'active' : '' }} {{ request()->is('marcas') ? 'active' : '' }} {{ request()->is('tipoequipos') ? 'active' : '' }} {{ request()->is('clasificacions') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tag"></i>
                        <p>
                            Productos
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('productos') }}" class="nav-link {{ request()->is('productos') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('marcas') }}" class="nav-link {{ request()->is('marcas') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Marcas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('tipoequipos') }}" class="nav-link {{ request()->is('tipoequipos') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tipo Equipos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('clasificacions') }}" class="nav-link {{ request()->is('clasificacions') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Clasificacion</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('impuestos') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('impuestos') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Configuracion
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('impuestos') }}" class="nav-link {{ request()->is('impuestos') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Impuestos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('empresa') }}" class="nav-link {{ request()->is('empresa') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Info. Empresa</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->
</aside>

