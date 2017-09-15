<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodigoToProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('proveedores', function (Blueprint $table) {
          $table->dropForeign('proveedores_linea_id_foreign');
          $table->dropUnique('proveedores_codigo_unique');
          $table->dropColumn('linea_id');
          $table->integer('linea')->after('name');
          $table->integer('estados_id')->unsigned()->after('name')->nullable();
          $table->foreign('estados_id')->references('id')->on('estados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proveedores', function (Blueprint $table) {
            //
        });
    }
}
