<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Rate\RateRepositoryInterface;

class RateController extends Controller
{
    protected $rateRepository;

    public function __construct(RateRepositoryInterface $rateRepository)
    {
        $this->rateRepository = $rateRepository;
    }

    public function storeRateSong(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->only(
                'target_id',
                'point',
                'user_id'
            );
            $rateType = config('settings.rate.song');
            $rating = $this->rateRepository->getRatingUser($input['target_id'], $input['user_id'], $rateType);
            if ($rating) {
                if ($input['point'] == 0) {
                    $deleteRate = $this->rateRepository->delete($rating['id']);
                } else {
                    $rate = $this->rateRepository->updateRate($input, $rateType);
                }
            } else {
                $newRate = $this->rateRepository->createRateOfUser($input, $rateType);
            }

            $song = $this->rateRepository->updateAverageRateSong($input['target_id']);
            $result = [
                'success' => true,
            ];
            return response()->json($result);
        }
    }

    public function storeRateAlbum(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->only(
                'target_id',
                'point',
                'user_id'
            );
            $rateType = config('settings.rate.album');
            $rating = $this->rateRepository->getRatingUser($input['target_id'], $input['user_id'], $rateType);
            if ($rating) {
                if ($input['point'] == 0) {
                    $deleteRate = $this->rateRepository->delete($rating['id']);
                } else {
                    $rate = $this->rateRepository->updateRate($input, $rateType);
                }
            } else {
                $newRate = $this->rateRepository->createRateOfUser($input, $rateType);
            }

            $album = $this->rateRepository->updateAverageRateAlbum($input['target_id']);
            $result = [
                'success' => true,
            ];
            return response()->json($result);
        }
    }
}
