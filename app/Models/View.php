<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
        'song_id',
        'view_count_all',
        'view_count_week',
        'view_count_month',
    ];

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
