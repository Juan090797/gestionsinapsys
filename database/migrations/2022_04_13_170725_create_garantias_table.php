<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarantiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garantias', function (Blueprint $table) {
            $table->id();
            $table->string('orden_compra')->nullable();
            $table->string('tiempo_garantia')->nullable();//meses
            $table->date('fin_garantia')->nullable();
            $table->string('estado')->default('CG');
            $table->boolean('if_mantenimiento')->nullable();
            $table->float('mant_total',10,0)->default(0);
            $table->float('mant_realizados',10,0)->default(0);
            $table->float('mant_pendientes',10,0)->default(0);
            $table->string('prioridad')->default('REGULAR');
            $table->longText('comentarios')->nullable();
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('producto_id')->constrained();
            $table->foreignId('pedido_id')->constrained();
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
        Schema::dropIfExists('garantias');
    }
}
