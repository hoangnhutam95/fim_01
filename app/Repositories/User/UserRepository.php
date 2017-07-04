<?php
namespace App\Repositories\User;

use Auth;
use App\Models\User;
use App\Repositories\BaseRepository;
use Exception;
use File;
use App\Helpers\SetFile;
use DB;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function create($request)
    {
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
        ];
        $name = SetFile::uploadAvatar($request);
        $input['avatar'] = isset($name) ? $name : config('settings.avatar_default');

        return $this->model->create($input);
    }

    public function update($input, $id)
    {
        $user = [
            'name' => $input['name'],
            'phone' => $input['phone'],
            'address' => $input['address'],
        ];
        $name = SetFile::uploadAvatar($input);
        $user['avatar'] = isset($name) ? $name : $input['current_img'];
        if ($input['current_img'] != config('settings.avatar_default') && isset($name)) {
            file::delete(config('settings.avatar_path') . $input['current_img']);
        }

        return $this->model->where('id', $id)->update($user);
    }

    public function delete($id)
    {
        $user = $this->model->find($id);
        DB::beginTransaction();
        try {
            if ($user['avatar'] != config('settings.avatar_default')) {
                file::delete(config('settings.avatar_path') . $user['avatar']);
            }
            $data = $this->model->destroy($id);
            if (!$data) {
                throw new Exception(trans('user.delete_error'));
            }
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;

            return false;
        }
    }

    public function getUser()
    {
        return $this->model->orderBy('name');
    }
}
