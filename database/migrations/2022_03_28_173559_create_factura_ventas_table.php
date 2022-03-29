<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_emision');
            $table->date('fecha_pago');
            $table->string('serie_documento');
            $table->string('numero_documento');
            $table->string('glosa')->nullable();
            $table->float('subtotal',40,2)->default(0.00);
            $table->float('igv',40,2)->default(0.00);
            $table->float('otros_cargos',40,2)->default(0.00);
            $table->float('total',40,2)->default(0.00);
            $table->string('moneda');
            $table->float('tipo_cambio',40,2)->default(0.00);
            $table->foreignId('pedido_id')->constrained();
            $table->foreignId('tipo_documento_id')->constrained();
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
        Schema::dropIfExists('factura_ventas');
    }
}
