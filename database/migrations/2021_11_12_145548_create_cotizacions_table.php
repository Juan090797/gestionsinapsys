<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->longText('terminos')->nullable();
            $table->longText('condiciones')->nullable();
            $table->boolean('foto')->nullable();
            $table->decimal('total',20,2)->default(0);
            $table->decimal('subtotal',20,2)->default(0);
            $table->decimal('impuesto',20,2)->default(0);
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('impuesto_id')->constrained();
            $table->foreignId('proyecto_id')->constrained();
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
        Schema::dropIfExists('cotizacions');
    }
}
