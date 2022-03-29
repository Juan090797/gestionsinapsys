<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentarioPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario_pedidos', function (Blueprint $table) {
            $table->id();
            $table->longText('contenido');
            $table->string('archivo')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('pedido_id')->constrained();
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
        Schema::dropIfExists('comentario_pedidos');
    }
}
