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
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('d_id');
            $table->integer('discount_type')->nullable();
            $table->string('coupen')->nullable();
            $table->string('description')->nullable();
            $table->string('amount')->nullable();
            $table->string('image')->nullable();
            $table->integer('premission')->nullable();
            $table->integer('total_spend')->nullable();
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
        Schema::dropIfExists('discounts');
    }
};
