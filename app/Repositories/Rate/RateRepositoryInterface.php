<?php
namespace App\Repositories\Rate;

interface RateRepositoryInterface
{
    public function getRatePointOfUser($targetId, $rateType);

    public function getRatingUser($targetId, $userId, $rateType);

    public function updateRate($input, $rateType);

    public function createRateOfUser($input, $rateType);

    public function updateAverageRateSong($songId);

    public function updateAverageRateAlbum($albumId);
}
