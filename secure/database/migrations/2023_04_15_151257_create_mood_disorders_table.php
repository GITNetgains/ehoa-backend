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
        Schema::create('mood_disorders', function (Blueprint $table) {
            $table->increments('disorders_id');
            $table->integer('disorders_type')->nullable();
            $table->string('name')->nullable();
            $table->string('icon')->nullable();
            $table->string('primary')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mood_disorders');
    }
};
