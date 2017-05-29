<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'cover',
        'type',
    ];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function hasCoverCategory()
    {
        $filePath = config('settings.cover_category_src') . $this->cover;

        return file_exists($filePath);
    }
}
