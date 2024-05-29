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
        Schema::create('auto_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id');
            $table->integer('order_by')->default(1);
            $table->string('title')->nullable();
            $table->boolean('status')->default(false);
            $table->bigInteger('discount_type_id');
            $table->string('discount_value')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->boolean('exclude_listed_categories_promotion')->default(false);
            $table->boolean('exclude_discounted_items')->default(false);
            $table->boolean('strict_mode')->default(false);
            $table->time('time_from')->nullable();
            $table->time('time_to')->nullable();
            $table->bigInteger('delivery_type_id');
            $table->boolean('use_gift')->default(false);
            $table->boolean('use_promotional_code')->default(false);
            $table->bigInteger('pickup_start_from')->nullable();
            $table->bigInteger('delivery_start_from')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_discounts');
    }
};
