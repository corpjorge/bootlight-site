<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('p_productos_id')->unsigned()->nullable();
            $table->foreign('p_productos_id')->references('id')->on('p_productos');
            $table->integer('estados_id')->unsigned()->nullable();
            $table->foreign('estados_id')->references('id')->on('estados_aprobaciones');            
            $table->string('cod_asociado')->nullable();
            $table->string('cedula')->nullable();
            $table->string('celular')->nullable();
            $table->string('monto')->nullable();
            $table->string('cuotas')->nullable();
            $table->string('taza')->nullable();
            $table->string('codigo')->nullable();
            $table->string('obs', '670')->nullable();
            $table->string('observacion', '670')->nullable();
            $table->string('img')->nullable();
            $table->date('pendiente')->nullable();
            $table->date('aprobado')->nullable();
            $table->date('negado')->nullable();
            $table->date('desembolsado')->nullable();
            $table->date('vendido')->nullable();       
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
        Schema::dropIfExists('p_solicitudes');
    }
}
