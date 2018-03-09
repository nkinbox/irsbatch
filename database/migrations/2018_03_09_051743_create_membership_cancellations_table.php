<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipCancellationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_cancellations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->text('reason')->nullable();
            $table->char('signature', 37)->nullable();
            $table->char('letter', 37)->nullable();
            $table->unsignedInteger('lobbyhead')->nullable();
            $table->unsignedInteger('corecommittee')->nullable();
            $table->enum('status', ['pending', 'approved', 'hold', 'declined'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_cancellations');
    }
}
