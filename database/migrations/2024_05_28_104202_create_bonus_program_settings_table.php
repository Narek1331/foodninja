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
        Schema::create('bonuses_program_settings', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id');
            $table->boolean('status')->default(false);
            $table->enum('expire', ['infinity', 'reset'])->default('infinity');
            $table->integer('delivery_percent')->nullable();
            $table->integer('self_delivery_percent')->nullable();
            $table->integer('registration_bonus')->nullable();
            $table->integer('birthday_bonus')->nullable();
            $table->boolean('allow_sale_product')->default(false);
            $table->boolean('allow_promocode')->default(false);
            $table->boolean('allow_bonus_product')->default(false);
            $table->boolean('allow_with_bonuses')->default(false);
            $table->boolean('exclude_categories')->default(false);
            $table->integer('payment_percent')->nullable();
            $table->boolean('payment_ignore_minimal_price')->default(false);
            $table->boolean('payment_ignore_delivery_price')->default(false);
            $table->boolean('payment_disable_with_promocode')->default(false);
            $table->boolean('payment_disable_with_bonus_product')->default(false);
            $table->boolean('payment_disable_with_sale_product')->default(false);
            $table->boolean('payment_exclude_categories')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonus_program_settings');
    }
};
