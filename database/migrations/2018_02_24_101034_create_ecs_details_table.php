<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEcsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecs_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('SNO', 6)->nullable();
            $table->string('UMRN', 50)->nullable();
            $table->string('BankCode', 20)->nullable();
            $table->string('Beneficiary_AccNo', 40);
            $table->string('Beneficiary_Name', 100);
            $table->string('Settlement_Date', 12)->nullable();
            $table->unsignedDecimal('Amount', 10, 2)->nullable();
            $table->string('Start_Date', 12)->nullable();
            $table->string('End_Date', 12)->nullable();
            $table->string('Frequency', 15)->nullable();
            $table->unsignedInteger('member_id')->nullable();
            $table->enum('status', ['Successful', 'Rejected', 'Returned'])->nullable();
            $table->unsignedInteger('original_file_id');
            $table->enum('existance', ['tracked', 'untracked', 'ignore'])->default('untracked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecs_details');
    }
}
