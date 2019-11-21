<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuSubAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_admin_sub', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_admin_id')->unsigned();
            $table->foreign('menu_admin_id')->references('id')->on('menu_admins');
            $table->integer('orden');
            $table->integer('areas_item_admin_id')->unsigned();
            $table->foreign('areas_item_admin_id')->references('id')->on('area_item_admins');
            $table->string('icono');
            $table->string('ruta');
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->string('estilo');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
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
        Schema::dropIfExists('menu_sub_admins');
    }
}
