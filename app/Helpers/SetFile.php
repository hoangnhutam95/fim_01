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
        if(isset($request['cover'])) {
            $file = Input::file('cover');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(config('settings.cover_category_path'), $name);

            return $name;
        }
    }
}
