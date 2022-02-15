<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoAlmacensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_almacens', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento')->nullable(); // GI(Guia de Ingreso),GS(Guia de salida), etc.
            $table->string('numero_guia')->nullable(); // 001-0000000001.
            $table->string('referencia')->nullable(); //numero de boleta o factura de la compra.
            $table->decimal('total',20,2)->default(0.00); //total $
            $table->decimal('total_items',20,2)->default(0.00); //total de items del movimiento
            $table->date('fecha_documento')->nullable(); //fecha que ingresa los productos a la empresa.
            $table->string('ruc_cliente')->nullable(); //ruc del cliente
            $table->string('nombre_cliente')->nullable(); //razon social del cliente
            $table->string('estado')->nullable();
            $table->foreignId('motivo_id')->constrained();
            $table->foreignId('centro_costo_id')->constrained();
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
        Schema::dropIfExists('movimiento_almacens');
    }
}
