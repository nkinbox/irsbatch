<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->enum('help', ['Suspension', 'Removal', 'Dissmissal', 'Death']);
            $table->char('request_letter', 37)->nullable();
            $table->char('official_order', 37)->nullable();
            $table->enum('status', ['Pending', 'Accepted', 'Declined', 'Hold']);
            $table->unsignedInteger('corecommittee_id')->nullable();
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
        Schema::dropIfExists('helps');
    }
}
