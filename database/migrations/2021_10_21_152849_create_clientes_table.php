<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('correo')->nullable();
            $table->string('direccion')->nullable();
            $table->string('estado');
            $table->string('pagina_web')->nullable();
            $table->string('telefono')->nullable();
            $table->longText('descripcion')->nullable();
            $table->string('ruc')->nullable();
            $table->string('razon_social')->nullable();
            $table->string('detalle_banco')->nullable();
            $table->string('ciudad_entrega')->nullable();
            $table->string('ciudad_recojo')->nullable();
            $table->longText('direccion_entrega')->nullable();
            $table->longText('direccion_recojo')->nullable();
            $table->string('pais_entrega')->nullable();
            $table->string('pais_recojo')->nullable();
            $table->string('usuario_auditoria');

            $table->foreignId('industria_id')->constrained();
            $table->foreignId('categoria_id')->constrained();
            $table->foreignId('tipo_documento_id')->constrained();
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
        Schema::dropIfExists('clientes');
    }
}
