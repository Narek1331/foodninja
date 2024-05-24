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
        Schema::create('widgets_settings', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id');
            $table->boolean('display_app_download_widget')->default(false);
            $table->boolean('display_popup_app_download_widget')->default(false);
            $table->boolean('turn_on')->default(false);
            $table->boolean('show_only_auth_users')->default(false);
            $table->integer('how_long_display')->default(60);
            $table->string('yes_button_text')->default('Да');
            $table->string('cancel_button_text')->default('Нет');
            $table->string('link_when_click_yes')->nullable();
            $table->string('heading')->nullable();
            $table->text('text_in_popup_window')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widgets_settings');
    }
};
