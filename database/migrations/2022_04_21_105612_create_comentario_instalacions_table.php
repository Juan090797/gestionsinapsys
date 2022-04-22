<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentarioInstalacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario_instalacions', function (Blueprint $table) {
            $table->id();
            $table->longText('texto')->nullable();
            $table->string('archivo')->nullable();
            $table->boolean('checked')->default(0);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('instalacion_id')->constrained();
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
        Schema::dropIfExists('comentario_instalacions');
    }
}
