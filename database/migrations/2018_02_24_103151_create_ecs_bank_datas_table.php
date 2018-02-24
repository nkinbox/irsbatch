<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcsBankDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecs_bank_data', function (Blueprint $table) {
            $table->increments('id');
            $table->char('transactions', 37);
            $table->char('returned', 37)->nullable();
            $table->char('rejected', 37)->nullable();
            $table->char('transactions_json', 37);
            $table->char('returned_json', 37)->nullable();
            $table->char('rejected_json', 37)->nullable();
            $table->char('ecs_month', 2);
            $table->char('ecs_year', 4);
            $table->unsignedInteger('member_id');
            $table->text('pointers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecs_bank_data');
    }
}
