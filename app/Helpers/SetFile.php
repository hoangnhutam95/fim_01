<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Input;

class SetFile
{
    public static function uploadAvatar($request)
    {
        if (isset($request['avatar'])) {
            $file = Input::file('avatar');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(config('settings.avatar_path'), $name);

            return $name;
        }
    }

    public static function uploadCover($request)
    {
        if (isset($request['cover'])) {
            $file = Input::file('cover');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(config('settings.cover_category_src'), $name);

            return $name;
        }
    }

    public static function uploadCoverAudio($request)
    {
        if (isset($request['cover'])) {
            $file = Input::file('cover');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(config('settings.audio_cover_src'), $name);

            return $name;
        }
    }

    public static function uploadAudio($request)
    {
        if (isset($request['link'])) {
            $file = Input::file('link');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(config('settings.audio_src'), $name);

            return $name;
        }
    }

    public static function uploadCoverVideo($request)
    {
        if (isset($request['cover'])) {
            $file = Input::file('cover');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(config('settings.video_cover_src'), $name);

            return $name;
        }
    }

    public static function uploadVideo($request)
    {
        if (isset($request['link'])) {
            $file = Input::file('link');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(config('settings.video_src'), $name);

            return $name;
        }
    }

    public static function uploadCoverAlbum($request)
    {
        if (isset($request['cover'])) {
            $file = Input::file('cover');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(config('settings.album_cover_src'), $name);

            return $name;
        }
    }

    public static function uploadCoverFavorite($request)
    {
        if (isset($request['cover'])) {
            $file = Input::file('cover');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(config('settings.favorite_cover_src'), $name);

            return $name;
        }
    }
}
