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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id');
            $table->string('title')->nullable();
            $table->string('h1_title')->nullable();
            $table->text('description')->nullable();
            $table->string('timezone')->nullable();
            $table->text('head_code')->nullable();
            $table->string('how_many_pieces_for_free_condiments')->nullable();
            $table->boolean('redirect_nonexistent_pages_to_home')->default(false);
            $table->boolean('site_search')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
