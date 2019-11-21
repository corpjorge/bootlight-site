<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('account_type')->comment('0 para Ahorros y 1 para Cte');
            $table->string('account');
            $table->date('opening')->nullable();
            $table->boolean('is_principal')->nullable();
            $table->unsignedInteger('bank_id');
            $table->unsignedInteger('person_id');

            $table->foreign('bank_id')
                ->references('id')
                ->on('banks');

            $table->foreign('person_id')
                ->references('id')
                ->on('people');

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
        Schema::dropIfExists('transactions');
    }
}
