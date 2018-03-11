<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('loan_type', ['Normal', 'Emergency']);
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('loan_incharge_id')->nullable();
            $table->unsignedInteger('cashier_id')->nullable();
            $table->unsignedInteger('president_id')->nullable();
            $table->char('loan_incharge_signature')->nullable();
            $table->char('cashier_signature')->nullable();
            $table->char('president_signature')->nullable();
            $table->date('applied_on')->nullable();
            $table->date('sanction_on')->nullable();
            $table->date('given_on')->nullable();
            $table->unsignedDecimal('amount', 8, 2)->default('0');
            $table->unsignedDecimal('fine_amount', 8, 2)->default('0');
            $table->unsignedDecimal('interest_amount', 8, 2)->default('0');
            $table->enum('status', ['Temp', 'Pending', 'Priority', 'Rejected', 'Active', 'Cleared'])->default('Temp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
