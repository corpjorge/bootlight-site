<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->string('nit')->nullable();
            $table->string('name');
            $table->integer('estados_id')->unsigned()->nullable();
            $table->foreign('estados_id')->references('id')->on('estados');
            $table->integer('linea');
            $table->integer('cuota_min')->nullable();
            $table->integer('cuota_max')->nullable();
            $table->integer('monto_min')->nullable();
            $table->integer('monto_max')->nullable();
            $table->integer('tipo')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('p_productos');
    }
}
