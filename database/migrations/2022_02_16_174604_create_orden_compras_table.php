<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_compras', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->date('fecha_documento')->nullable();
            $table->string('referencia')->nullable();
            $table->string('estado')->nullable();
            $table->longText('terminos')->nullable();
            $table->decimal('subtotal',20,2)->default(0.00);
            $table->decimal('impuesto',20,2)->default(0.00);
            $table->decimal('total',20,2)->default(0.00);
            $table->decimal('total_items',20,2)->default(0.00);
            $table->foreignId('proveedor_id')->constrained();
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
        Schema::dropIfExists('orden_compras');
    }
}
