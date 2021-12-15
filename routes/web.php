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
    Route::get('tipoequipos', \App\Http\Livewire\Familias::class);
    Route::get('productos', \App\Http\Livewire\Productos::class);
    Route::get('clasificacions', \App\Http\Livewire\Clasificacions::class);
    Route::get('proyectos', \App\Http\Livewire\Proyectos::class)->name('proyectos');
    Route::get('proyectos/{proyecto}', \App\Http\Livewire\ShowProyecto::class)->name('proyecto.show');
    Route::get('cotizacion/{proyecto}', \App\Http\Livewire\Cotizacion::class)->name('cotizacion');
    Route::get('cotizacion/{cotizacion}/show', \App\Http\Livewire\ShowCotizacion::class)->name('cotizacion.show');
    Route::get('cotizacion/{cotizacion}/edit', \App\Http\Livewire\EditCotizacion::class)->name('cotizacion.edit');
    Route::get('clientes/exports/', [\App\Http\Controllers\ExportController::class, 'exportCliente']);
    Route::post('clientes/imports/', [\App\Http\Controllers\ImportController::class, 'importCliente']);
    Route::get('productos/exports/', [\App\Http\Controllers\ExportController::class, 'exportProducto']);
    Route::post('productos/imports/', [\App\Http\Controllers\ImportController::class, 'importProducto']);
    Route::get('impuestos', \App\Http\Livewire\Impuestos::class);
    Route::get('empresa', \App\Http\Livewire\Empresas\Empresas::class);
    Route::get('pedidos', \App\Http\Livewire\Pedidos\Pedidos::class);
    Route::get('pedidocreate', \App\Http\Livewire\Pedidos\PedidoCreate::class)->name('pedidocreate');
    Route::get('unidades', \App\Http\Livewire\UnidadesMedida::class);
});

