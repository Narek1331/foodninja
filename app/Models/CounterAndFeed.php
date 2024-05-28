<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMerchantId;
use App\Models\Scopes\MerchantScope;

class CounterAndFeed extends Model
{
    use HasFactory, HasMerchantId;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'counters_and_feeds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id',
        'yandex_metrics_code',
        'yandex_metrica_counter_id',
        'google_analytics_code',
        'vk_code_pixel',
        'vk_price_list_id',
        'facebook_pixel_code',
        'tiktok_pixel_code',
    ];


    protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }

}
