<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteDetail extends Model
{
    protected $fillable = [
        'favorite_id',
        'song_id',
    ];

    public function favorite()
    {
        return $this->belongsTo(Favorite::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
