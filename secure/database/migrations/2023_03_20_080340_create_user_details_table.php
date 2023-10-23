<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('u_id');
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('dob')->nullable();
            $table->string('community_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('pronounce')->nullable();
            $table->integer('average_cycle_length')->nullable();
            $table->integer('average_cycle_days')->nullable();
            $table->integer('language_id')->nullable();
            $table->integer('reminder_set')->nullable();
            $table->integer('subscription')->nullable();
            $table->integer('country_id')->nullable();
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
        Schema::dropIfExists('user_details');
    }
};
