<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrievancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grievances', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('stage', ['LobbyHead', 'CoreCommittee', 'President', 'Solved']);
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('lobbyhead_id')->nullable();
            $table->unsignedInteger('corecommittee_id')->nullable();
            $table->unsignedInteger('president_id')->nullable();
            $table->char('file_name', 37)->nullable();
            $table->char('member_signature', 37)->nullable();
            $table->char('lobbyhead_signature', 37)->nullable();
            $table->char('president_signature', 37)->nullable();
            $table->timestamps();
            $table->text('member_text')->nullable();
            $table->text('lh_text')->nullable();
            $table->text('cc_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grievances');
    }
}
