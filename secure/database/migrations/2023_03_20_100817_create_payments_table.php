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
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('pay_id');
            $table->integer('user_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('payment_data')->nullable();
            $table->integer('payment_status')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('remarks')->nullable();
            $table->string('currency')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('gateway_response')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
