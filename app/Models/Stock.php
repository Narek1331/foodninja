<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMerchantId;
use App\Models\Scopes\MerchantScope;

class Stock extends Model
{
    use HasFactory, HasMerchantId;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'display_location_id',
        'merchant_id',
        'title',
        'text',
        'img_path',
        'status',
        'promo_code'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }

    public function displayLocation(){
        return $this->belongsTo(DisplayLocation::class);
    }

}
