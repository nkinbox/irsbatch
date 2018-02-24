<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->enum('status', ['success','pending','unverified'])->nullable();
            $table->unsignedDecimal('fees_amount', 8, 2)->default('1000');
            $table->unsignedDecimal('fine_amount', 8, 2)->default('0');
            $table->unsignedDecimal('paid_amount', 8, 2)->default('0');
            $table->char('fees_month', 2);
            $table->char('fees_year', 4);
            $table->date('pay_date')->nullable();
            $table->enum('pay_method', ['ECS', 'CASH', 'TRANSFER', 'ONLINE'])->nullable();
            $table->unsignedInteger('ecs_id')->nullable();
            $table->unsignedInteger('cash_to')->nullable();
            $table->unsignedInteger('receipt_file')->nullable();
            $table->unsignedInteger('txn_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_fees');
    }
}
