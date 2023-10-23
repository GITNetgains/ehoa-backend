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
        Schema::create('cycles', function (Blueprint $table) {
            $table->increments('c_id');
            $table->integer('user_id')->nullable();
            $table->string('cycle_start_date')->nullable();
            $table->string('cycle_end_date')->nullable();
            $table->integer('manuslation_flow_id')->nullable();
            $table->integer('symptom_id')->nullable();
            $table->integer('emotion_type_id')->nullable();
            $table->integer('energy_type_id')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('cycles');
    }
};
