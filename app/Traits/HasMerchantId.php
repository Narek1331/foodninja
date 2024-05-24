<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait HasMerchantId
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    protected static function bootHasMerchantId()
    {
        static::creating(function ($model) {
            $model->merchant_id = Auth::user()->merchant_id ?? 1;
        });
    }
}
