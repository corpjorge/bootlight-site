<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimuladorTasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulador_tasas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('simulador_linea_id')->unsigned();
            $table->foreign('simulador_linea_id')->references('id')->on('simulador_lineas');
            $table->string('valor');
            $table->string('anual');
            $table->integer('plazo_inicial');
            $table->integer('plazo_final');
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
        Schema::dropIfExists('simulador_tasas');
    }
}
