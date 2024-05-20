<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'story_id',
        'order_by',
        'img_path',
        'youtube_video_url',
        'description',
        'status'
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }



}
