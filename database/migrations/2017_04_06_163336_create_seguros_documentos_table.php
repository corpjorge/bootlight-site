<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegurosDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguros_documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seguros_producto_id')->unsigned();
            $table->foreign('seguros_producto_id')->references('id')->on('seguros_productos');
            $table->string('nombre');
            $table->string('ruta')->nullable();
            $table->string('tipo')->nullable();
            $table->string('tamaño')->nullable();
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
        Schema::dropIfExists('seguros_documentos');
    }
}
