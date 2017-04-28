<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'user_id',
        'target_id',
        'type',
        'point',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class, 'target_id');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'target_id');
    }
}
