<?php
namespace App\Repositories\Category;

use Auth;
use App\Models\Category;
use App\Models\Song;
use App\Repositories\BaseRepository;
use Exception;
use File;
use App\Helpers\SetFile;
use DB;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected $songModel;

    public function __construct(
        Category $category,
        Song $song
    ) {
        $this->model = $category;
        $this->songModel = $song;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $input = [
                'name' => $request['name'],
                'type' => $request['type'],
            ];
            $name = SetFile::uploadCover($request);
            $input['cover'] = isset($name) ? $name : config('settings.cover_default');
            $category = $this->model->create($input);
            DB::commit();

            return $category;
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    public function getAll()
    {
        $categories = $this->model->paginate(config('settings.admin_category'));

        return $categories;
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $this->songModel->where('category_id', $id)->update(['category_id' => null]);
            $category = $this->model->destroy($id);
            if ($category['cover'] != config('settings.cover_default')) {
                File::delete(config('settings.cover_category_src') . $category['cover']);
            }
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB:: rollback();

            return false;
        }
    }

    public function update($request, $id)
    {
        $category = $this->model->find($id);
        if (!$category) {
            return false;
        }

        DB::beginTransaction();
        try {
            $category['name'] = $request['name'];
            $category['type'] = $request['type'];
            $name = SetFile::uploadCover($request);
            if ($name) {
                $category['cover'] = $name;
                if ($request['current_img'] != config('settings.cover_default')) {
                    File::delete(config('settings.cover_category_path') . $request['current_img']);
                }
            } else {
                $category['cover'] = $request['current_img'];
            }
            $categoryUpdate = $category->save();
            DB::commit();

            return $categoryUpdate;
        } catch (Exception $e) {
            DB:: rollback();

            return false;
        }
    }

    public function getListSongCategories()
    {
        return $this->model
            ->where('type', config('settings.category.song'))
            ->orderBy('name', 'asc')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function getListAlbumCategories()
    {
        return $this->model
            ->where('type', config('settings.category.album'))
            ->orderBy('name', 'asc')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function getSongCategories()
    {
        return $this->model->where('type', config('settings.category.song'))->get();
    }

    public function getAlbumCategories()
    {
        return $this->model->where('type', config('settings.category.album'))->get();
    }
}
