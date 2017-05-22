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
            ];
            $name = SetFile::uploadCover($request);
            $input['cover'] = isset($name) ? $name : config('settings.cover_category_defaut');
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
            File::delete(config('settings.cover_category') . $category['cover']);
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
            $name = SetFile::uploadCover($request);
            if ($name) {
                $category['cover'] = $name;
                File::delete(config('settings.cover_category') . $request['current_img']);
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

    public function getListCategories()
    {
        return $this->model->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
    }
}
