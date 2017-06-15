<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegurosEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguros_estados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seguro_id')->unsigned();
            $table->foreign('seguro_id')->references('id')->on('seguros');
            $table->integer('estado_aprobacion_id')->unsigned();
            $table->foreign('estado_aprobacion_id')->references('id')->on('estados_aprobaciones');
            $table->string('observacion')->nullable();
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
        Schema::dropIfExists('seguros_estados');
    }
}
