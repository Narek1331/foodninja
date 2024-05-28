<?php

namespace App\Models\MenuSetting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMerchantId;
use App\Models\Scopes\MerchantScope;

class MenuSettingItem extends Model
{
    use HasFactory, HasMerchantId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_setting_id',
        'merchant_id',
        'url',
        'link_text',
        'new_window',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }
}
