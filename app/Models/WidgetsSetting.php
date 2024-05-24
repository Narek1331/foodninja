<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMerchantId;
use App\Models\Scopes\MerchantScope;

class WidgetsSetting extends Model
{
    use HasFactory, HasMerchantId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'merchant_id',
        'display_app_download_widget',
        'display_popup_app_download_widget',
        'turn_on',
        'show_only_auth_users',
        'how_long_display',
        'yes_button_text',
        'cancel_button_text',
        'link_when_click_yes',
        'heading',
        'text_in_popup_window',
        'display_app_download_widget',
        'display_popup_app_download_widget'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }


}
