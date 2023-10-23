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
        Schema::create('yogas', function (Blueprint $table) {
            $table->increments('yoga_id');
            $table->integer('parent_type');
            $table->string('yoga_description')->nullable();
            $table->string('yoga_additional_info')->nullable();
            $table->string('yoga_image')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('yogas');
    }
};
