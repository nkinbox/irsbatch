<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveExtraEcsDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecs_details', function (Blueprint $table) {
            $table->dropColumn('SNO');
            $table->dropColumn('UMRN');
            $table->dropColumn('BankCode');
            $table->dropColumn('Beneficiary_Name');
            $table->dropColumn('Settlement_Date');
            $table->dropColumn('Start_Date');
            $table->dropColumn('End_Date');
            $table->dropColumn('Frequency');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ecs_details', function (Blueprint $table) {
            //
        });
    }
}
