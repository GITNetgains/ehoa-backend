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
        Schema::create('moonphases', function (Blueprint $table) {
            $table->increment('moon_phase_id');
            $table->string('moon_phases_name')->nullable();
            $table->string('short_description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moonphases');
    }
};
