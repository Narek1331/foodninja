<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMerchantId;
use App\Models\Scopes\MerchantScope;

class Page extends Model
{
    use HasFactory, HasMerchantId;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'text',
        'status',
        'merchant_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }
}
