<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChequeInMembershipfeesStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('membership_fees', function (Blueprint $table) {
            $table->dropColumn('pay_method');
            $table->dropColumn('cash_to');
        });
        Schema::table('membership_fees', function (Blueprint $table) {
            $table->enum('pay_method', ['ECS', 'CASH', 'TRANSFER', 'ONLINE', 'CHEQUE'])->nullable();
             $table->unsignedInteger('given_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('membership_fees', function (Blueprint $table) {
            $table->dropColumn('pay_method');
            $table->dropColumn('given_to');
        });
        Schema::table('membership_fees', function (Blueprint $table) {
            $table->enum('pay_method', ['ECS', 'CASH', 'TRANSFER', 'ONLINE'])->nullable();
            $table->unsignedInteger('cash_to')->nullable();
        });
    }
}
