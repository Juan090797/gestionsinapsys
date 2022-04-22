<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('canal_comunicacion')->nullable();
            $table->longText('txt_incidencia')->nullable();
            $table->string('prioridad')->nullable();
            $table->boolean('if_visita')->nullable();
            $table->date('fecha_aviso')->nullable();
            $table->dateTime('fecha_ejecucion')->nullable();
            $table->string('estado')->default('ASIGNADO');
            $table->date('fecha_cierre')->nullable();
            $table->longText('notas')->nullable();
            $table->string('reporte')->nullable();
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('contacto_id')->constrained();
            $table->foreignId('producto_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('incidencias');
    }
}
