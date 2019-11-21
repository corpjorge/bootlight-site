<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Menuuserssub extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_users_sub', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_user_id')->unsigned();
            $table->foreign('menu_user_id')->references('id')->on('menu_users');
            $table->integer('orden');
            $table->integer('areas_item_id')->unsigned();
            $table->foreign('areas_item_id')->references('id')->on('areas_items');
            $table->string('icono');
            $table->string('ruta');
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->string('estilo');
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
          Schema::dropIfExists('menu_users_sub');
    }
}
