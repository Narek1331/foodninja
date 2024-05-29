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
        Schema::create('dayables', function (Blueprint $table) {
            $table->unsignedBigInteger('day_id');
            $table->morphs('dayable');

            $table->timestamps();

            // $table->foreign('day_id')
            // ->references('id')
            // ->on('days')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dayables');
    }
};
