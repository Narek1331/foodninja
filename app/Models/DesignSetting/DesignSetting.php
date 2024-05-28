<?php

namespace App\Models\DesignSetting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMerchantId;
use App\Models\Scopes\MerchantScope;

class DesignSetting extends Model
{
    use HasFactory, HasMerchantId;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'main_color',
       'secondary_color',
       'dark_theme',
       'full_width',
       'header_new_version',
       'background',
       'use_colors_for_admin_panel',
       'modal_close_only_by_cross',
       'font_id',
       'favicon_path',
       'logo_light_background_path',
       'og_img_path',
       'empty_cart_img_path',
       'checkout_success_page_img_path',
       'checkout_error_page_img_path',
       'modal_off_hours_img_path',
       'modal_disabled_platform_img_path',
       'error_occurs_img_path',
       'free_soy_img_path',
       'free_wasabi_img_path',
       'free_ginger_img_path',
       'cap_id',
       'mobile_menu_id',
       'banner_id',
       'category_menu_id',
       'product_id',
       'discount_sticker_on_goods',
       'add_to_cart_button_text',
       'product_image_background',
       'stretch_photo_width',
       'crop_photo_height',
       'product_variation_id',
       'footer_id',
       'logo_dark_background_path',
   ];

   public function params(){
       return $this->hasMany(DesignSetting::class);
   }

   protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }
}
