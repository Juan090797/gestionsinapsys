<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{asset('img/coorporacion.ico')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text" style="color:white">GRUPO SINAPSYS</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="color:white">{{ Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item {{ request()->is('dashboard') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt" style="color:white"></i>
                        <p style="color:white">
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
                @hasanyrole('Administrador|Ventas')
                <li class="nav-item">
                    <a href="{{ url('proyectos') }}" class="nav-link {{ request()->is('proyectos') ? 'active' : '' }}">
                        <i class="nav-icon far fa-calendar-alt" style="color:white"></i>
                        <p style="color:white">Proyectos</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('clientes') ? 'menu-open' : '' }} {{ request()->is('categorias') ? 'menu-open' : '' }} {{ request()->is('industrias') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('clientes') ? 'active' : '' }} {{ request()->is('categorias') ? 'active' : '' }} {{ request()->is('industrias') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-users" style="color:white"></i>
                        <p style="color:white">
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
                @endhasanyrole
                @hasanyrole('Logistica|Administrador')
                <li class="nav-item {{ request()->is('productos') ? 'menu-open' : '' }} {{ request()->is('marcas') ? 'menu-open' : '' }} {{ request()->is('tipoequipos') ? 'menu-open' : '' }} {{ request()->is('clasificacions') ? 'menu-open' : '' }} {{ request()->is('unidades') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('productos') ? 'active' : '' }} {{ request()->is('marcas') ? 'active' : '' }} {{ request()->is('tipoequipos') ? 'active' : '' }} {{ request()->is('clasificacions') ? 'active' : '' }} {{ request()->is('unidades') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tag" style="color: white"></i>
                        <p style="color: white">
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
                            <a href="{{ url('clasificacions') }}" class="nav-link {{ request()->is('clasificacions') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Clasificacion</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('unidades') }}" class="nav-link {{ request()->is('unidades') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Unid. Medidas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endhasanyrole
                @role('Administrador')
                <li class="nav-item {{ request()->is('impuestos') ? 'menu-open' : '' }} {{ request()->is('empresa') ? 'menu-open' : '' }} {{ request()->is('centrocostos') ? 'menu-open' : '' }} {{ request()->is('tipo-documentos') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('impuestos') ? 'active' : '' }} {{ request()->is('empresa') ? 'active' : '' }} {{ request()->is('centrocostos') ? 'active' : '' }} {{ request()->is('tipo-documentos') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs" style="color: white"></i>
                        <p style="color: white">
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
                        <li class="nav-item">
                            <a href="{{ url('centrocostos') }}" class="nav-link {{ request()->is('centrocostos') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Centro Costos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('tipo-documentos') }}" class="nav-link {{ request()->is('tipo-documentos') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tipo documentos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->is('pedidos') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register" style="color:white"></i>
                        <p style="color:white">
                            Ventas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('pedidos') }}" class="nav-link {{ request()->is('pedidos') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pedidos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->is('purchases') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-plane" aria-hidden="true" style="color:white"></i>
                        <p style="color:white">
                            Importaciones
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('purchases') }}" class="nav-link {{ request()->is('purchases') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purshase Orders</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @hasanyrole('Logistica|Administrador')
                <li class="nav-item {{ request()->is('compras') ? 'menu-open' : '' }} {{ request()->is('importaciones') ? 'menu-open' : '' }} {{ request()->is('ordenes') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('compras') ? 'active' : '' }} {{ request()->is('importaciones') ? 'active' : '' }} {{ request()->is('ordenes') ? 'active' : '' }}">
                        <i class="nav-icon far fa-money-bill-alt" style="color: white"></i>
                        <p style="color: white">
                            Compras
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('compras') }}" class="nav-link {{ request()->is('compras') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Registros Compras</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('importaciones') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Importaciones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('ordenes') }}" class="nav-link {{ request()->is('ordenes') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ordenes Compras</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endhasanyrole
                @hasanyrole('Logistica|Administrador')
                <li class="nav-item {{ request()->is('tipoproveedores') ? 'menu-open' : '' }} {{ request()->is('proveedores') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('tipoproveedores') ? 'active' : '' }} {{ request()->is('proveedores') ? 'active' : '' }}">
                        <i class="nav-icon far fas fa-dolly-flatbed" style="color:white"></i>
                        <p style="color:white">
                            Proveedores
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('proveedores') }}" class="nav-link {{ request()->is('proveedores') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Proveedores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('tipoproveedores') }}" class="nav-link {{ request()->is('tipoproveedores') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tipos Proveedores</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endhasanyrole
                <li class="nav-item {{ request()->is('caja') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('caja') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tag" style="color: white"></i>
                        <p style="color: white">
                            Tesoreria
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('caja') }}" class="nav-link {{ request()->is('caja') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Caja chica</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('facturas') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('facturas') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tag" style="color:white"></i>
                        <p style="color:white">
                            Contabilidad
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('facturas') }}" class="nav-link {{ request()->is('facturas') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reg. Fac. Ventas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('garantias') ? 'menu-open' : '' }} {{ request()->is('incidencias') ? 'menu-open' : '' }} {{ request()->is('instalaciones') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('garantias') ? 'active' : '' }} {{ request()->is('incidencias') ? 'active' : '' }} {{ request()->is('instalaciones') ? 'menu-open' : '' }}">
                        <i class="fa fa-american-sign-language-interpreting nav-icon" aria-hidden="true" style="color:white"></i>
                        <p style="color:white">
                            PostVenta
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('garantias') }}" class="nav-link {{ request()->is('garantias') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Garantias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('incidencias') }}" class="nav-link {{ request()->is('incidencias') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Incidencias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('instalaciones') }}" class="nav-link {{ request()->is('instalaciones') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Instalaciones</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('tareas') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('tareas') ? 'active' : '' }}">
                        <i class="fa fa-user-md nav-icon" aria-hidden="true" style="color:white"></i>
                        <p style="color:white">
                            Soporte Tecnico
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('tareas') }}" class="nav-link {{ request()->is('tareas') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tareas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @role('Administrador')
                <li class="nav-item {{ request()->is('ingresos') ? 'menu-open' : '' }} {{ request()->is('salidas') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('ingresos') ? 'active' : '' }} {{ request()->is('salidas') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box-open" style="color: white"></i>
                        <p style="color: white">
                            Almacen
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('ingresos') }}" class="nav-link {{ request()->is('ingresos') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ingresos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('salidas') }}" class="nav-link {{ request()->is('salidas') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Salidas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('requerimientos') }}" class="nav-link {{ request()->is('requerimientos') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Requerimientos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole
                @role('Administrador')
                <li class="nav-item {{ request()->is('usuarios') ? 'menu-open' : '' }} {{ request()->is('roles') ? 'menu-open' : '' }} {{ request()->is('permisos') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('usuarios') ? 'active' : '' }} {{ request()->is('roles') ? 'active' : '' }} {{ request()->is('permisos') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-key" style="color: white"></i>
                        <p style="color: white">
                            Seguridad
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('usuarios') }}" class="nav-link {{ request()->is('usuarios') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('roles') }}" class="nav-link {{ request()->is('roles') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('permisos') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permisos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole
                @hasanyrole('Logistica|Administrador')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-question-circle" style="color: #00a87d"></i>
                        <p style="color: #00a87d">
                            Consultas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('kardex-producto') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kardex(producto)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('kardex-general') }}" class="nav-link {{ request()->is('kardex-general') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kardex(general)</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endhasanyrole
                <li class="nav-item">
                    <a href="{{ url('mensajes') }}" class="nav-link {{ request()->is('mensajes') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comments" style="color: yellow"></i>
                        <p style="color: yellow">Mensajes</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->
</aside>

