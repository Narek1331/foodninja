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
        Schema::create('displayables', function (Blueprint $table) {
            $table->unsignedBigInteger('display_location_id');
            $table->morphs('displayable');

            $table->timestamps();

            // $table->foreign('display_location_id')
            // ->references('id')
            // ->on('display_locations')
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
