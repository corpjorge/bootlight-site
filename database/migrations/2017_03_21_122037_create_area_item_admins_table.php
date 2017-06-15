<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaItemAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_item_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_admin_id')->unsigned();
            $table->foreign('area_admin_id')->references('id')->on('area_admins');
            $table->string('name');
            $table->string('descripcion');
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
        Schema::dropIfExists('area_item_admins');
    }
}
