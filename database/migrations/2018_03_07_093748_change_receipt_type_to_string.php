<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeReceiptTypeToString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('membership_fees', function (Blueprint $table) {
            $table->dropColumn('receipt_file');
        });
        Schema::table('membership_fees', function (Blueprint $table) {
            $table->char('receipt_file', 37)->after('cheque_id')->nullable();
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
            $table->dropColumn('receipt_file');
        });
        Schema::table('membership_fees', function (Blueprint $table) {
            $table->unsignedInteger('receipt_file')->after('cheque_id')->nullable();
        });
    }
}
