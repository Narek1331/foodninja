<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'display_location_id',
        'status',
        'order_by',
        'img_path'
    ];

    public function displayLocation(){
        return $this->belongsTo(DisplayLocation::class);
    }

    public function images(){
        return $this->hasMany(StoryImage::class);
    }
}
