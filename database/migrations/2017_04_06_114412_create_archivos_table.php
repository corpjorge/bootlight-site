<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('archivos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users');
          $table->integer('seguro_id')->unsigned();
          $table->foreign('seguro_id')->references('id')->on('seguros');
          $table->integer('estado_aprobacion_id')->unsigned();
          $table->foreign('estado_aprobacion_id')->references('id')->on('estados_aprobaciones');
          $table->string('nombre');
          $table->string('ruta');
          $table->string('tipo');
          $table->string('tamaño');
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
        Schema::dropIfExists('archivos');
    }
}
