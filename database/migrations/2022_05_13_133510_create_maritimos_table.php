<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaritimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maritimos', function (Blueprint $table) {
            $table->id();
            $table->integer('num_bl')->nullable();
            $table->string('linea_naviera')->nullable();
            $table->string('buque_salida')->nullable();
            $table->string('buque_llegada')->nullable();
            $table->integer('contenedores')->nullable();
            $table->integer('viaje')->nullable();
            $table->string('vb')->nullable();
            $table->string('operador_portuario')->nullable();
            $table->string('mbl')->nullable();
            $table->string('manifiesto')->nullable();
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
        Schema::dropIfExists('maritimos');
    }
}
