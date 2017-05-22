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
}
