<?php

namespace App\Repositories\Song;

interface SongRepositoryInterface
{
    public function getListAudios();

    public function getListVideos();

    public function createAudio($request);

    public function updateAudio($input, $id);

    public function deleteAudio($id);

    public function createVideo($request);

    public function updateVideo($input, $id);

    public function deleteVideo($id);

    public function searchSong($keyword);

    public function searchAudio($keyword);

    public function searchVideo($keyword);

    public function getAudioOfSinger($id);

    public function getVideoOfSinger($id);

    public function getNewAudio();

    public function getHotAudio();

    public function getHotVideo();

    public function getListAudioOfAlbum($albumId);

    public function getAudioOfTopic($categoryId);

    public function getVideoOfTopic($categoryId);

    public function searchAudioHome($keyword);

    public function searchVideoHome($keyword);

    public function getTopRateAudio();

    public function getTopRateVideo();

    public function getListAudioOfFavorite($favoriteId);
}
