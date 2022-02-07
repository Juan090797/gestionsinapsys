<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoAlmacenDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_almacen_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movimiento_almacens_id')->constrained();
            $table->foreignId('producto_id')->constrained();
            $table->decimal('stock_old',20,2)->default(0.00);
            $table->decimal('cantidad')->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimiento_almacen_detalles');
    }
}
