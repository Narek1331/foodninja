<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMerchantId;
use App\Models\Scopes\MerchantScope;

class TextBlocksSettings extends Model
{
    use HasFactory, HasMerchantId;

    protected $fillable = [
        'merchant_id',
        'mobile_install_text',
        'cart_hint',
        'hint_choosing_delivery',
        'pre_order_hint',
        'site_footer_text'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }
}
