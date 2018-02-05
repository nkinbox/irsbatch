<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApprovalStgnatures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->char('adm_incharge', 37)->after('nominee_photograph')->nullable();
            $table->char('cashier', 37)->after('adm_incharge')->nullable();
            $table->char('vice_president', 37)->after('cashier')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('adm_incharge');
            $table->dropColumn('cashier');
            $table->dropColumn('vice_president');
        });
    }
}
