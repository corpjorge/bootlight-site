<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Permisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

          Schema::create('permisos', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('area_admin_id')->unsigned();
                $table->foreign('area_admin_id')->references('id')->on('area_admins');
                $table->foreign('admin_user_id')->references('id')->on('admin_users');
                $table->integer('admin_user_id')->unsigned();
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
         Schema::drop('permisos');
    }
}
