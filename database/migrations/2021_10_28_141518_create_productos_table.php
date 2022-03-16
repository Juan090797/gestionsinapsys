<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->longText('nombre')->nullable();
            $table->string('modelo')->nullable();
            $table->decimal('stock',20,2)->default(0.00);
            $table->string('estado')->default('Activo');
            $table->longText('descripcion')->nullable();
            $table->decimal('precio_venta',20,2)->default(0.00);
            $table->decimal('precio_compra',20,2)->default(0.00);
            $table->string('tipo')->nullable();
            $table->foreignId('marca_id')->constrained();
            $table->foreignId('clasificacions_id')->constrained();
            $table->foreignId('unidad_medidas_id')->constrained();
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
        Schema::dropIfExists('productos');
    }
}
