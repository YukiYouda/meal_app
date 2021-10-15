<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getImagePathAttribute()
    {
        return 'images/posts/' . $this->image;
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    public function getTime()
    {
        $interval = strtotime(date('Y-m-d H:i:s')) - strtotime($this->created_at);
        
        if ($interval < 60) {
            return $interval . '秒';
        } elseif ($interval < 3600) {
            return floor($interval / 60) . '分';
        } elseif ($interval < 86400) {
            return floor($interval / (60 * 60)) . '時間';
        } elseif ($interval < 604800) {
            return floor($interval / (24 * 60 * 60)) . '日';
        } else {
            return floor($interval / (30 * 24 * 60 * 60)) . 'ヶ月';
        }
    }
}
