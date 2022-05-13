<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pagina');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('dashboard', \App\Http\Livewire\Dashboard::class)->name('dashboard');
    Route::get('categorias', \App\Http\Livewire\Categorias::class);
    Route::get('industrias', \App\Http\Livewire\Industrias::class);
    Route::get('clientes', \App\Http\Livewire\Clientes::class);
    Route::resource('clients', \App\Http\Controllers\ClienteController::class)->only('show');
    Route::get('marcas', \App\Http\Livewire\Marcas::class);
    Route::get('productos', \App\Http\Livewire\Productos::class);
    Route::get('clasificacions', \App\Http\Livewire\Clasificacions::class);
    Route::get('proyectos', \App\Http\Livewire\Proyectos::class)->name('proyectos');
    Route::get('proyectos/{proyecto}', \App\Http\Livewire\ShowProyecto::class)->name('proyecto.show');
    Route::get('cotizacion/{proyecto}', \App\Http\Livewire\Cotizaciones\CreateCotizacion::class)->name('cotizacion.create');
    Route::get('cotizacion/{cotizacion}/show', \App\Http\Livewire\Cotizaciones\ShowCotizacion::class)->name('cotizacion.show');
    Route::get('cotizacion/{cotizacion}/edit', \App\Http\Livewire\Cotizaciones\EditCotizacion::class)->name('cotizacion.edit');
    Route::get('impuestos', \App\Http\Livewire\Impuestos::class);
    Route::get('empresa', \App\Http\Livewire\Empresas\Empresas::class);
    Route::get('pedidos', \App\Http\Livewire\Pedidos\Pedidos::class)->name('pedidos');
    Route::get('pedidocreate', \App\Http\Livewire\Pedidos\PedidoCreate::class)->name('pedido.create');
    Route::get('pedido/{pedido}/show', \App\Http\Livewire\Pedidos\PedidoShow::class)->name('pedido.show');
    Route::get('pedido/{pedido}/edit', \App\Http\Livewire\Pedidos\PedidoEdit::class)->name('pedido.edit');
    Route::get('unidades', \App\Http\Livewire\UnidadesMedida::class)->name('unidades');
    Route::get('tipoproveedores', \App\Http\Livewire\TipoProveedores::class)->name('tipoproveedores');
    Route::get('proveedores', \App\Http\Livewire\Proveedores::class)->name('proveedores');
    Route::get('centrocostos', \App\Http\Livewire\CentroCostos::class)->name('centrocostos');
    Route::get('compras', \App\Http\Livewire\Compras\Compras::class)->name('compras');
    Route::get('compracreate', \App\Http\Livewire\Compras\CreateCompra::class)->name('compracreate');
    Route::get('compra/{compra}/edit', \App\Http\Livewire\Compras\ComprasEdit::class)->name('compra.edit');
    Route::get('ingresos', \App\Http\Livewire\Ingresos\Ingresos::class)->name('ingresos');
    Route::get('ingresoscreate', \App\Http\Livewire\Ingresos\IngresosCreate::class)->name('ingresoscreate');
    Route::get('ingreso/{ingreso}/show', \App\Http\Livewire\Ingresos\IngresosShow::class)->name('ingreso.show');
    Route::get('ingreso/{ingreso}/edit', \App\Http\Livewire\Ingresos\IngresosEdit::class)->name('ingreso.edit');
    Route::get('salidas', \App\Http\Livewire\Salidas\Salidas::class)->name('salidas');
    Route::get('salidascreate', \App\Http\Livewire\Salidas\SalidasCreate::class)->name('salidascreate');
    Route::get('salida/{salida}/show', \App\Http\Livewire\Salidas\SalidasShow::class)->name('salida.show');
    Route::get('salida/{salida}/edit', \App\Http\Livewire\Salidas\SalidasEdit::class)->name('salida.edit');
    Route::get('usuarios', \App\Http\Livewire\Usuarios\Usuarios::class)->name('usuarios');
    Route::get('mensajes', \App\Http\Livewire\mensajes\ListaConversacion::class)->name('mensajes');
    Route::get('kardex-producto', \App\Http\Livewire\Kardex\KardexProducto::class)->name('kardex-producto');
    Route::get('kardex-general', \App\Http\Livewire\Kardex\KardexGeneral::class)->name('kardex.general');
    Route::get('ordenes', \App\Http\Livewire\Ordenes\ListaOrdenes::class)->name('ordenes');
    Route::get('ordencreate', \App\Http\Livewire\Ordenes\CreateOrdenes::class)->name('orden.create');
    Route::get('orden/{orden}/show', \App\Http\Livewire\Ordenes\ShowOrdenes::class)->name('orden.show');
    Route::get('roles', \App\Http\Livewire\Roles\ListaRoles::class)->name('roles');
    Route::get('caja', \App\Http\Livewire\Caja\ListaCaja::class)->name('caja');
    Route::get('caja/{caja}/movimientos', \App\Http\Livewire\Caja\ListaMovimientos::class)->name('caja-movimientos');
    Route::get('movimiento/{movimiento}/show', \App\Http\Livewire\Caja\ShowMovimiento::class)->name('movimiento-show');
    Route::get('tipo-documentos', \App\Http\Livewire\TipoDocumento\ListaTipos::class)->name('tipo-documentos');
    Route::get('facturas', \App\Http\Livewire\Pedidos\Facturas\ListaFacturas::class)->name('facturas');
    Route::get('garantias', \App\Http\Livewire\Garantias\ListaGarantias::class)->name('garantias');
    Route::get('garantia/{garantia}/show', \App\Http\Livewire\Garantias\ShowGarantia::class)->name('garantia.show');
    Route::get('incidencias', \App\Http\Livewire\Incidencias\ListaIncidencias::class)->name('incidencias');
    Route::get('tareas', \App\Http\Livewire\Tareas\ListaTareas::class)->name('tareas');
    Route::get('incidencia/{incidencia}/show', \App\Http\Livewire\Tareas\VerIncidencia::class)->name('incidencia.show');
    Route::get('mantenimiento/{mantenimiento}/show', \App\Http\Livewire\Tareas\VerMantenimiento::class)->name('mantenimiento.show');
    Route::get('instalaciones', \App\Http\Livewire\Instalaciones\ListaInstalaciones::class)->name('instalaciones');
    Route::get('instalacion/{instalacion}/show', \App\Http\Livewire\Tareas\VerInstalacion::class)->name('instalacion.show');
    Route::get('purchases', \App\Http\Livewire\Importaciones\ListaPurcharse::class)->name('purchases');
    Route::get('purchase-create', \App\Http\Livewire\Importaciones\CreatePurcharse::class)->name('purchase.create');
    Route::get('purchase/{purchase}/show', \App\Http\Livewire\Importaciones\ShowPurcharse::class)->name('purchase.show');
    Route::get('purchase/{purchase}/costo-create', \App\Http\Livewire\Importaciones\CreateCosto::class)->name('costo.create');
    Route::get('purchase/{purchase}/costo-show', \App\Http\Livewire\Importaciones\ShowCosto::class)->name('costo.show');
});

