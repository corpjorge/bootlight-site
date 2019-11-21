<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orden');
            $table->integer('area_admin_id')->unsigned();
            $table->foreign('area_admin_id')->references('id')->on('area_admins');
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
        Schema::dropIfExists('menu_admins');
    }
}
