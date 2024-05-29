<?php

namespace App\Models\Discount;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMerchantId;
use App\Models\Scopes\MerchantScope;
use App\Models\Day;
use App\Models\DisplayLocation;

class AutoDiscount extends Model
{
    use HasFactory, HasMerchantId;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auto_discounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id',
        'title',
        'status',
        'discount_type_id',
        'discount_value',
        'date_from',
        'date_to',
        'exclude_listed_categories_promotion',
        'exclude_discounted_items',
        'strict_mode',
        'time_from',
        'time_to',
        'use_gift',
        'use_promotional_code',
        'delivery_start_from',
        'pickup_start_from',
        'delivery_type_id',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }

    public function days()
    {
        return $this->morphToMany(Day::class, 'dayable');
    }

    public function displayLocations()
    {
        return $this->morphToMany(DisplayLocation::class, 'displayable');
    }
}
