<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('users_detalles', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('user_id')->unsigned();
              $table->foreign('user_id')->references('id')->on('users');
              $table->string('cedula')->unique();
              $table->string('cod_persona');
              $table->date('fecha_nacimiento');
              $table->string('almacen');
              $table->string('cuidad');
              $table->string('genero');
              $table->string('direccion');
              $table->string('estado_vinculacion');
              $table->integer('estado_civil_id')->unsigned();
              $table->foreign('estado_civil_id')->references('id')->on('estado_civil');            
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
        Schema::drop('users_detalles');
    }
}
