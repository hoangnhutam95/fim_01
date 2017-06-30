<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'name',
        'cover',
        'link',
        'description',
        'publish_date',
        'type',
        'author',
        'category_id',
        'singer_id',
        'rate_number',
        'rate_point',
        'comment_number',
        'is_hot',
    ];

    public function singer()
    {
        return $this->belongsTo(Singer::class);
    }

    public function lyrics()
    {
        return $this->hasMany(Lyric::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function albumDetail()
    {
        return $this->belongsTo(AlbumDetail::class);
    }

    public function favoriteDetail()
    {
        return $this->belongsTo(FavoriteDetail::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function view()
    {
        return $this->belongsTo(View::class, 'id', 'song_id');
    }

    public function getAudioCoverPath()
    {
        return asset(config('settings.audio_cover_path') . $this->cover);
    }

    public function hasCoverAudio()
    {
        $filePath = config('settings.audio_cover_src') . $this->cover;

        return file_exists($filePath);
    }

    public function hasFileAudio()
    {
        $filePath = config('settings.audio_src') . $this->link;

        return file_exists($filePath);
    }

    public function hasCoverVideo()
    {
        $filePath = config('settings.video_cover_src') . $this->cover;

        return file_exists($filePath);
    }

    public function hasFileVideo()
    {
        $filePath = config('settings.video_src') . $this->link;

        return file_exists($filePath);
    }
}
