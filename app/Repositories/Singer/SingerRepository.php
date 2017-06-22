<?php

namespace App\Repositories\Singer;

use Auth;
use App\Models\Singer;
use App\Repositories\BaseRepository;
use Exception;
use App\Models\Song;
use File;
use App\Helpers\SetFile;
use DB;

class SingerRepository extends BaseRepository implements SingerRepositoryInterface
{
    protected $songModel;

    public function __construct(Singer $singer, Song $song)
    {
        $this->model = $singer;
        $this->songModel = $song;
    }

    public function getListSingers()
    {
        return $this->model->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
    }

    public function createSinger($request)
    {
        $input = [
            'name' => $request['name'],
            'role' => $request['role'],
        ];
        $nameAvatarImage = SetFile::uploadAvatar($request);
        $input['avatar'] = isset($nameAvatarImage) ? $nameAvatarImage : config('settings.avatar_default');

        return $this->model->create($input);
    }

    public function updateSinger($input, $id)
    {
        $singer = [
            'name' => $input['name'],
            'role' => $input['role'],
        ];
        $nameAvatarImage = SetFile::uploadAvatar($input);
        $singer['avatar'] = isset($nameAvatarImage) ? $nameAvatarImage : $input['current_img'];
        if ($input['current_img'] != config('settings.avatar_default') && isset($name)) {
            file::delete(config('settings.avatar_path') . $input['current_img']);
        }

        return $this->model->find($id)->update($singer);
    }

    public function deleteSinger($id)
    {
        DB::beginTransaction();
        try {
            $this->songModel->where('singer_id', $id)->update(['singer_id' => null]);
            $data = $this->model->destroy($id);
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function searchSinger($keyword)
    {
        return $this->model->where('name', 'like', "%$keyword%");
    }

    public function getSinger()
    {
        return $this->model->orderBy('name');
    }

    public function searchSingerHome($keyword)
    {
        return $this->model->where('name', 'like', "%$keyword%")->orderBy('name');
    }
}
