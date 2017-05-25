<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    protected $fillable = [
        'name',
        'avatar',
        'role',
    ];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function getRole()
    {
        if ($this->role == 1) {
            return config('settings.singer.solo');
        } elseif ($this->role == 2) {
            return config('settings.singer.duet');
        } elseif ($this->role == 3) {
            return config('settings.singer.group');
        }

        return config('settings.singer.other');
    }

    public function hasAvatar()
    {
        $filePath = config('settings.avatar_path') . $this->avatar;

        return file_exists($filePath);
    }
}
