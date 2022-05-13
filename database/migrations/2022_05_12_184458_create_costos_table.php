<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained();
            $table->foreignId('producto_id')->constrained();
            $table->foreignId('proveedor_id')->constrained();
            $table->string('tipo_costeo')->nullable();
            $table->integer('invoice')->nullable();
            $table->float('peso', 20, 2)->default(0.00);
            $table->string('origen')->nullable();
            $table->boolean('express')->default(0);
            $table->integer('bultos')->nullable();
            $table->float('volumen', 20, 2)->default(0.00);
            $table->string('consignatario')->nullable();
            $table->date('consolidacion')->default(now());
            $table->date('salida')->default(now());
            $table->string('almacen')->nullable();
            $table->string('agente')->nullable();
            $table->morphs('costeable');
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
        Schema::dropIfExists('costos');
    }
}
