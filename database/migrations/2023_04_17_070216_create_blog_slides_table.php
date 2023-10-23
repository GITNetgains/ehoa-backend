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
        Schema::create('blog_slides', function (Blueprint $table) {
            $table->increments('slide_id');
            $table->string('blog_id')->nullable;
            $table->string('slide_title')->nullable;
            $table->string('slide_description')->nullable;
            $table->string('slide_image')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_slides');
    }
};
