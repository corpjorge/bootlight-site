<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegurosRadicadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguros_radicados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seguro_id')->unsigned();
            $table->foreign('seguro_id')->references('id')->on('seguros');
            $table->string('valor_seguro')->nullable();
            $table->string('cuota')->nullable();
            $table->string('linea')->nullable();
            $table->string('cupo')->nullable();
            $table->string('cupo_valor')->nullable();
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
        Schema::dropIfExists('producto_radicados');
    }
}
