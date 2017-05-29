<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'name',
        'cover',
        'publish_date',
        'category_id',
        'publish_date',
        'rate_number',
        'rate_point',
        'comment_number',
        'is_hot',
    ];

    public function albumDetails()
    {
        return $this->hasMany(AlbumDetail::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hasCoverAlbum()
    {
        $filePath = config('settings.album_cover_src') . $this->cover;

        return file_exists($filePath);
    }
}
