<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('venta_detalles', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('venta_id')->unsigned();
          $table->foreign('venta_id')->references('id')->on('ventas');
          $table->integer('serial_id')->unsigned();
          $table->foreign('serial_id')->references('id')->on('seriales');        
          $table->string('referencia');
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
        Schema::dropIfExists('venta_detalles');
    }
}
