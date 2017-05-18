<?php

namespace App\Repositories\Song;

interface SongRepositoryInterface
{
    public function getListAudios();

    public function createAudio($request);

    public function updateAudio($input, $id);
}
