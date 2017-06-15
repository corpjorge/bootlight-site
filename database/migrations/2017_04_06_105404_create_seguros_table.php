<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegurosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('seguros_producto_id')->unsigned();
            $table->foreign('seguros_producto_id')->references('id')->on('seguros_productos');
            $table->string('caso_delima')->nullable();        
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estados_aprobaciones');
            $table->string('observacion_general');
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
        Schema::dropIfExists('seguros');
    }
}
