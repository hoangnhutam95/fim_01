<?php
namespace App\Repositories\View;

interface ViewRepositoryInterface
{
    public function updateViewCount($songId);

    public function getTopViewAllAudio();

    public function getTopViewWeekAudio();

    public function getTopViewMonthAudio();

    public function getTopViewAllVideo();

    public function getTopViewWeekVideo();

    public function getTopViewMonthVideo();

    public function getViewOfSong($songId);
}
