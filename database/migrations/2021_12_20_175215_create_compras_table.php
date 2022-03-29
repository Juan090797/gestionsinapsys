<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('periodo');
            $table->string('serie_documento');
            $table->string('numero_documento');
            $table->date('fecha_documento');
            $table->date('fecha_pago');
            $table->string('moneda');
            $table->float('tipo_cambio',20,4)->default(0.00);
            $table->string('estado');
            $table->longText('detalle')->nullable();
            $table->float('subtotal',20,2)->default(0.00);
            $table->float('impuesto',20,2)->default(0.00);
            $table->float('no_gravadas',20,2)->default(0.00);
            $table->float('icbper',20,2)->default(0.00);
            $table->float('otros_gastos',20,2)->default(0.00);
            $table->float('total',20,2)->default(0.00);
            $table->float('total_items',20,2)->default(0.00);
            $table->foreignId('tipo_documento_id')->constrained();
            $table->foreignId('proveedor_id')->constrained();
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
        Schema::dropIfExists('compras');
    }
}
