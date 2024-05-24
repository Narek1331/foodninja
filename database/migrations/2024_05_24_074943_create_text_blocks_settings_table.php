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
        Schema::create('text_blocks_settings', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id');
            $table->longText('mobile_install_text');
            $table->longText('cart_hint');
            $table->longText('hint_choosing_delivery');
            $table->longText('pre_order_hint');
            $table->longText('site_footer_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_blocks_settings');
    }
};
