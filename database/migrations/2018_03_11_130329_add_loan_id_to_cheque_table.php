<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoanIdToChequeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cheques', function (Blueprint $table) {
            $table->unsignedInteger('loan_id')->default(0)->after('id');
            $table->enum('used_for', ['membership', 'loan', 'repayment'])->default('membership')->after('added_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cheques', function (Blueprint $table) {
            $table->dropColumn('loan_id');
            $table->dropColumn('used_for');
        });
    }
}
