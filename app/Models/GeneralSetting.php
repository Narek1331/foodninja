<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMerchantId;
use App\Models\Scopes\MerchantScope;

class GeneralSetting extends Model
{
    use HasFactory,HasMerchantId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id',
        'title',
        'h1_title',
        'description',
        'timezone',
        'head_code',
        'how_many_pieces_for_free_condiments',
        'redirect_nonexistent_pages_to_home',
        'site_search'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }
}
