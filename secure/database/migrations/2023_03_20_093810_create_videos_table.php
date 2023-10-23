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
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('videos_id');
            $table->integer('category_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('file_url')->nullable();
            $table->string('thumbnails')->nullable();
            $table->string('video')->nullable();
            $table->string('video_length')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('videos');
    }
};
