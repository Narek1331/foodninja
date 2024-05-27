<?php

namespace App\Models\Maintenance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMerchantId;
use App\Models\Scopes\MerchantScope;
class MaintenanceSetting extends Model
{
    use HasFactory, HasMerchantId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'display_location_id',
        'maintenance_setting_mode_id',
        'turned_on_date',
        'turned_off_date',
        'title',
        'text',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new MerchantScope);
    }

    public function mode()
    {
        return $this->belongsTo(MaintenanceSettingMode::class);
    }
}
