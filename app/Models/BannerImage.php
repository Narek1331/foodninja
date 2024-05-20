<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'banner_id',
        'order_by',
        'autoscroll_seconds',
        'img_path',
        'img_full_path',
        'new_window',
    ];

    public function banner(){
        return $this->belongsTo(Banner::class);
    }

    public $sortable = [
        'order_column_name' => 'order_by',
        'sort_when_creating' => true,
    ];
}
