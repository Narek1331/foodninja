<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMerchantId;
use App\Models\Scopes\MerchantScope;

class BonusProgramSetting extends Model
{
    use HasFactory, HasMerchantId;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bonuses_program_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id',
        'status',
        'expire',
        'delivery_percent',
        'self_delivery_percent',
        'registration_bonus',
        'birthday_bonus',
        'allow_sale_product',
        'allow_promocode',
        'allow_bonus_product',
        'allow_with_bonuses',
        'exclude_categories',
        'payment_percent',
        'payment_ignore_minimal_price',
        'payment_ignore_delivery_price',
        'payment_disable_with_promocode',
        'payment_disable_with_bonus_product',
        'payment_disable_with_sale_product',
        'payment_exclude_categories',
    ];


    protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }
}
