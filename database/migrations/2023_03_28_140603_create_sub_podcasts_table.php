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
        Schema::create('sub_podcasts', function (Blueprint $table) {
            $table->increments('s_p_id ');
            $table->integer('sub_p_id');
            $table->integer('parent_type');
            $table->integer('sub_child_parent_type');
            $table->string('sub_podcast_description');
            $table->string('sub_podcast_additional_info');
            $table->string('sub_podcast_image');
            $table->string('sub_podcast_video');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_podcasts');
    }
};
