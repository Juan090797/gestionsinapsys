<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAereosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aereos', function (Blueprint $table) {
            $table->id();
            $table->integer('num_awb')->nullable();
            $table->string('aerolinea')->nullable();
            $table->date('eta')->default(now());
            $table->integer('guia_madre')->nullable();
            $table->string('operador_aeroportuario')->nullable();
            $table->integer('otro')->nullable();
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
        Schema::dropIfExists('aereos');
    }
}
