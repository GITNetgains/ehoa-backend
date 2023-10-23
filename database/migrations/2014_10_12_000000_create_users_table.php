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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('name')->nullable(); 
            $table->string('email')->unique();
            $table->timestamp('email_verified_at');
            $table->string('password')->nullable();
            $table->string('register_type')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('custom_gender')->nullable();
            $table->string('status')->nullable();
            $table->integer('pronoun_id')->nullable();
            $table->string('custom_pronoun')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->integer('user_notification_status')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->string('custom_group')->nullable();
            $table->integer('is_term')->nullable();
            $table->integer('data_security_accepted')->nullable();
            $table->integer('is_social')->nullable();
            $table->integer('google_cal_synced_status')->nullable();
            $table->integer('focus_id')->nullable();
            $table->integer('language_id')->nullable();
            $table->integer('average_cycle_length')->nullable();
            $table->integer('average_cycle_days')->nullable();
            $table->integer('period_day')->nullable();
            $table->integer('package_expiry_date')->nullable();
            $table->string('package_start_date')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
