<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->longText('terminos');
            $table->string('plazo_entrega');
            $table->string('txt_plazo');
            $table->string('garantia');
            $table->string('txt_garantia');
            $table->string('direccion_entrega');
            $table->string('num_mantenimiento')->nullable();
            $table->string('txt_mantenimiento')->nullable();
            $table->string('atendido');
            $table->boolean('foto')->nullable();
            $table->string('archivo_cotizacion')->nullable();
            $table->float('total',20,2)->default(0);
            $table->float('subtotal',20,2)->default(0);
            $table->float('impuesto',20,2)->default(0);
            $table->float('total_items',20,2)->nullable();
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('impuesto_id')->constrained();
            $table->foreignId('proyecto_id')->constrained();
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
        Schema::dropIfExists('cotizacions');
    }
}
