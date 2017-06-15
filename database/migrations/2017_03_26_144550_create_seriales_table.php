<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seriales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->string('numero')->unique();
            $table->string('precio_compra');
            $table->string('precio_publico');
            $table->string('precio_venta');
            $table->date('fecha_caducidad');
            $table->integer('admin_user_id')->unsigned()->nullable();;
            $table->foreign('admin_user_id')->references('id')->on('admin_users');
            $table->integer('estado_actual_id')->unsigned();
            $table->foreign('estado_actual_id')->references('id')->on('estados_aprobaciones');             
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
        Schema::dropIfExists('seriales');
    }
}
