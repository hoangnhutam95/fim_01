<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumDetail extends Model
{
    protected $fillable = [
        'album_id',
        'song_id',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
