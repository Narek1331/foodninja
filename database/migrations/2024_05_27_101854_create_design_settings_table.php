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
        Schema::create('design_settings', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id');
            $table->string('main_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->boolean('dark_theme')->default(false);
            $table->boolean('full_width')->default(false);
            $table->boolean('header_new_version')->default(false);
            $table->string('background')->nullable();
            $table->boolean('use_colors_for_admin_panel')->default(false);
            $table->boolean('modal_close_only_by_cross')->default(false);
            $table->bigInteger('font_id')->nullable();
            $table->string('favicon_path')->nullable();
            $table->string('logo_light_background_path')->nullable();
            $table->string('logo_dark_background_path')->nullable();
            $table->string('og_img_path')->nullable();
            $table->string('empty_cart_img_path')->nullable();
            $table->string('checkout_success_page_img_path')->nullable();
            $table->string('checkout_error_page_img_path')->nullable();
            $table->string('modal_off_hours_img_path')->nullable();
            $table->string('modal_disabled_platform_img_path')->nullable();
            $table->string('error_occurs_img_path')->nullable();
            $table->string('free_soy_img_path')->nullable();
            $table->string('free_wasabi_img_path')->nullable();
            $table->string('free_ginger_img_path')->nullable();
            $table->bigInteger('cap_id')->nullable();
            $table->bigInteger('mobile_menu_id')->nullable();
            $table->bigInteger('banner_id')->nullable();
            $table->bigInteger('category_menu_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->boolean('discount_sticker_on_goods')->default(false);
            $table->string('add_to_cart_button_text')->nullable();
            $table->string('product_image_background')->nullable();
            $table->boolean('stretch_photo_width')->default(false);
            $table->boolean('crop_photo_height')->default(false);
            $table->bigInteger('product_variation_id')->nullable();
            $table->bigInteger('footer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_settings');
    }
};
