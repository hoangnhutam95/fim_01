<?php
namespace App\Repositories\User;

use Auth;
use App\Models\User;
use App\Repositories\BaseRepository;
use Exception;
use File;
use App\Helpers\SetFile;

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
}
