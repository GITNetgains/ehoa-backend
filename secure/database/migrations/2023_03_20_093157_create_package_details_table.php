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
        Schema::create('package_details', function (Blueprint $table) {
            $table->increments('pc_id');
            $table->string('package_name')->nullable();
            $table->integer('tips_id')->nullable();
            $table->integer('videos_id')->nullable();
            $table->integer('yoga_id')->nullable();
            $table->integer('podcasts_id')->nullable();
            $table->integer('blogs_id')->nullable();
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
        Schema::dropIfExists('package_details');
    }
};
