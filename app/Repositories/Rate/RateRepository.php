<?php

namespace App\Repositories\Rate;

use Auth;
use App\Models\Rating;
use App\Models\Song;
use App\Models\Album;
use App\Repositories\BaseRepository;
use Exception;
use File;
use DB;

class RateRepository extends BaseRepository implements RateRepositoryInterface
{
    protected $songModel;
    protected $albumModel;

    public function __construct(Rating $rating, Song $song, Album $album)
    {
        $this->model = $rating;
        $this->songModel = $song;
        $this->albumModel = $album;
    }

    public function getRatePointOfUser($targetId, $rateType)
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $rate = $this->model
                ->where('type', $rateType)
                ->where('user_id', $userId)
                ->where('target_id', $targetId)
                ->first();
            return $rate ? $rate['point'] : 0;
        }
        return 0;
    }

    public function getRatingUser($targetId, $userId, $rateType)
    {
        return $this->model
            ->where('type', $rateType)
            ->where('target_id', $targetId)
            ->where('user_id', $userId)
            ->first();
    }

    public function updateRate($input, $rateType)
    {
        $rate = $this->model
            ->where('type', $rateType)
            ->where('target_id', $input['target_id'])
            ->where('user_id', $input['user_id'])
            ->first();

        return $rate->update(['point' => $input['point']]);
    }

    public function createRateOfUser($input, $rateType)
    {
        $rate = [
            'user_id' => $input['user_id'],
            'target_id' => $input['target_id'],
            'type' => $rateType,
            'point' => $input['point'],
        ];

        return $this->model->create($rate);
    }

    public function updateAverageRateSong($songId)
    {
        $rate = $this->model
            ->where('type', config('settings.rate.song'))
            ->where('target_id', $songId)
            ->get();
        $ratePoint = ($rate->count('user_id')) ? ($rate->sum('point') / $rate->count('user_id')) : 0;
        $input = [
            'rate_number' => $rate->count(),
            'rate_point' => $ratePoint,
        ];

        return $this->songModel->find($songId)->update($input);
    }

    public function updateAverageRateAlbum($albumId)
    {
        $rate = $this->model
            ->where('type', config('settings.rate.album'))
            ->where('target_id', $albumId)
            ->get();
        $ratePoint = ($rate->count('user_id')) ? ($rate->sum('point') / $rate->count('user_id')) : 0;
        $input = [
            'rate_number' => $rate->count(),
            'rate_point' => $ratePoint,
        ];

        return $this->albumModel->find($albumId)->update($input);
    }
}
