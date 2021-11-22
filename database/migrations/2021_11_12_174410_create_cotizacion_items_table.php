<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacion_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cotizacion_id')->constrained();
            $table->foreignId('producto_id')->constrained();
            $table->string('cantidad');
            $table->decimal('precio',20,2)->default(0);
            $table->decimal('monto',20,2)->default(0);
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
        Schema::dropIfExists('cotizacion_items');
    }
}
