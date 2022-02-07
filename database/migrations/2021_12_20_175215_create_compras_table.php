<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento')->nullable();
            $table->string('numero_documento')->nullable();
            $table->date('fecha_documento')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->decimal('subtotal',20,2)->default(0.00);
            $table->decimal('impuesto',20,2)->default(0.00);
            $table->decimal('total',20,2)->default(0.00);
            $table->decimal('total_items',20,2)->default(0.00);
            $table->foreignId('proveedor_id')->constrained();
            $table->foreignId('centro_costo_id')->constrained();
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
        Schema::dropIfExists('compras');
    }
}
