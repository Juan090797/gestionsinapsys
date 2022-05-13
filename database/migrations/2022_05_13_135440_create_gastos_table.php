<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('costo_id')->constrained();
            $table->string('concepto')->nullable();
            $table->enum('tipo', ['ORIGEN', 'DESTINO', 'AGENCIAMIENTO', 'DERECHOS']);
            $table->integer('cantidad')->default(0);
            $table->float('subtotal',20,2)->default(0.00);
            $table->float('igv',20,2)->default(0.00);
            $table->float('total',20,2)->default(0.00);
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
        Schema::dropIfExists('gastos');
    }
}
