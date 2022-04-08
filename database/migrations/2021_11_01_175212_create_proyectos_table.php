<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('prioridad');
            $table->string('estado');
            $table->decimal('ingreso_estimado',20,2)->default(0);
            $table->decimal('gasto_estimado',20,2)->default(0);
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('etapa_id')->constrained();
            $table->timestamps();
        });
    }

    /**.0
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
