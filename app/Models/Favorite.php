<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'name',
        'cover',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoriteDetails()
    {
        return $this->hasMany(FavoriteDetail::class);
    }

    public function hasCoverFavorite()
    {
        $filePath = config('settings.favorite_cover_src') . $this->cover;

        return file_exists($filePath);
    }
}
