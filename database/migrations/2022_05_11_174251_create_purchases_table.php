<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->date('fecha')->default(now());
            $table->string('moneda')->default('USD');
            $table->string('incoterm')->nullable();
            $table->float('subtotal')->default(0.00);
            $table->float('salestax')->default(0.00);
            $table->float('handling')->default(0.00);
            $table->float('other')->default(0.00);
            $table->float('total')->default(0.00);
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
        Schema::dropIfExists('purchases');
    }
}
