<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMerchantId;
use App\Models\Scopes\MerchantScope;

class Banner extends Model
{
    use HasFactory, HasMerchantId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'display_location_id',
        'merchant_id'
    ];

    public function displayLocation(){
        return $this->belongsTo(DisplayLocation::class);
    }

    public function images(){
        return $this->hasMany(BannerImage::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }
}
