<?php
namespace App\Repositories\Lyric;

interface LyricRepositoryInterface
{
    public function getWattingLyric();

    public function getCurrentLyric($id);

    public function acceptLyric($id);

    public function getSongLyric($songId);

    public function searchSugestLyric($keyword);

    public function getListLyricOfSong($songId);

    public function createLyric($request);
}
