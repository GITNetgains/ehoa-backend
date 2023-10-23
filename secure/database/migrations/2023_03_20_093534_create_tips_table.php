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
        Schema::create('tips', function (Blueprint $table) {
            $table->increments('t_id');
            $table->integer('energy_id');
            $table->integer('sub_energy_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('image');
            $table->string('title');
            $table->string('description');
            $table->string('expiry');
            $table->integer('status');
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
        Schema::dropIfExists('tips');
    }
};
