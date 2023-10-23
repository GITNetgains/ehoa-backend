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
        Schema::create('sub_yogas', function (Blueprint $table) {
            $table->increments('s_y_id');
            $table->integer('sub_y_id');
            $table->integer('sub_parent_type');
            $table->integer('sub_parent_child_type');
            $table->string('sub_tips_description');
            $table->string('sub_tips_additional_info');
            $table->string('sub_tips_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_yogas');
    }
};
