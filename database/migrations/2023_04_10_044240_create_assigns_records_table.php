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
        Schema::create('assigns_records', function (Blueprint $table) {
            $table->increments('as_id');
            $table->integer('cat_id');
            $table->integer('b_id')->nullable();
            $table->integer('p_id')->nullable();
            $table->integer('v_id')->nullable();
            $table->integer('y_id')->nullable();
            $table->integer('t_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigns_records');
    }
};
