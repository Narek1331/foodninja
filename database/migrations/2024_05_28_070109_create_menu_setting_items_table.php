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
        Schema::create('menu_setting_items', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id');
            $table->unsignedBigInteger('menu_setting_id');
            $table->string('url')->nullable();
            $table->string('link_text')->nullable();
            $table->boolean('new_window')->default(false);
            $table->integer('order_by')->default(1);
            $table->timestamps();
            // $table->foreign('menu_setting_id')
            // ->references('id')
            // ->on('menu_settings')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_setting_items');
    }
};
