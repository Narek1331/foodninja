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
        Schema::create('counters_and_feeds', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id');
            $table->text('yandex_metrics_code')->nullable();
            $table->string('yandex_metrica_counter_id')->nullable();
            $table->text('google_analytics_code')->nullable();
            $table->text('vk_code_pixel')->nullable();
            $table->string('vk_price_list_id')->nullable();
            $table->text('facebook_pixel_code')->nullable();
            $table->text('tiktok_pixel_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counters_and_feeds');
    }
};
