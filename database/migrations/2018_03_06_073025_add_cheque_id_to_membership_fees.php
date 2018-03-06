<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChequeIdToMembershipFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('membership_fees', function (Blueprint $table) {
            $table->unsignedInteger('cheque_id')->nullable()->after('ecs_id');
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
            $table->dropColumn('cheque_id');
        });
    }
}
