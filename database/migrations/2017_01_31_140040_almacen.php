<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Almacen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('almacenes', function (Blueprint $table) {
              $table->increments('id');
              $table->string('name');
              $table->string('direccion');
              $table->integer('ciudades_id')->unsigned();
              $table->foreign('ciudades_id')->references('id')->on('ciudades');
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
        Schema::drop('almacenes');
    }
}
