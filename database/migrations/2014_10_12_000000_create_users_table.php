<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('membership')->default(false);
            $table->enum('membership_status', ['pending','accepted','rejected','suspended'])->default('pending');
            $table->char('membership_code', 10)->unique()->nullable();
            $table->char('password', 60)->nullable();
            $table->char('remember_token', 60)->nullable();
            $table->char('api_token', 60)->nullable();
            $table->unsignedInteger('position_id')->default(3);
            $table->enum('salutation', ['Mr.','Ms.','Mrs.'])->nullable();
            $table->string('name', 100);
            $table->string('father_husband_name', 100)->nullable();
            $table->string('pf_no', 40)->nullable();
            $table->string('designation', 40)->nullable();
            $table->string('hq', 45);
            $table->date('dob')->nullable();
            $table->date('doa')->nullable();
            $table->date('dor')->nullable();
            $table->char('mobile_no', 10);
            $table->string('acc_no', 40)->nullable();
            $table->string('bank_name', 50)->nullable();
            $table->string('branch_name', 50)->nullable();
            $table->string('ifsc_code', 20)->nullable();
            $table->string('pan_card', 20)->nullable();
            $table->string('id_number', 20)->nullable();
            $table->string('railway_id', 45)->nullable();
            $table->unsignedInteger('introduce_no')->nullable();
            $table->enum('nominee_salutation', ['Mr.','Ms.','Mrs.'])->nullable();
            $table->string('nominee_name', 100)->nullable();
            $table->string('relationship', 30)->nullable();
            $table->string('nominee_phone', 10)->nullable();
            $table->string('nominee_acc_no', 40)->nullable();
            $table->string('nominee_bank_name', 50)->nullable();
            $table->string('nominee_branch_name', 50)->nullable();
            $table->string('nominee_ifsc_code', 20)->nullable();
            $table->date('applied_on')->nullable();
            $table->date('approved_on')->nullable();
            $table->string('address', 200)->nullable();
            $table->string('permanent_address', 200)->nullable();
            $table->string('nominee_address', 200)->nullable();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
