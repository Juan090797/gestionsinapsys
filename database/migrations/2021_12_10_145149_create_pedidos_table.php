<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('estado')->default('En Proceso');
            $table->string('codigo')->nullable();
            $table->string('ordencompra')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->string('guiaremision')->nullable();
            $table->decimal('total',20,2)->default(0);
            $table->decimal('subtotal',20,2)->default(0);
            $table->decimal('impuesto',20,2)->default(0);
            $table->string('total_items')->nullable();
            $table->string('cotizacion_id')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->foreignId('cliente_id')->constrained();
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
        Schema::dropIfExists('pedidos');
    }
}
