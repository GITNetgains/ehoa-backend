<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_symptoms', function (Blueprint $table) {
            $table->increments('user_symptom_id');
            $table->integer('user_id');
            $table->integer('menstrual_flow');
            $table->string('symptoms');
            $table->integer('emotions');
            $table->integer('energy');
            $table->string('journal');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_symptoms');
    }
};
