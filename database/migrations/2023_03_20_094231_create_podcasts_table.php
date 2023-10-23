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
        Schema::create('podcasts', function (Blueprint $table) {
            $table->increments('p_id');
            // $table->integer('parent_type');
            $table->string('category_id');
            $table->string('sub_category_id');
            $table->string('title');
            $table->string('description');
            $table->string('file_url')->nullable();
            $table->string('thumbnail');
            $table->string('audio')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('podcasts');
    }
};
