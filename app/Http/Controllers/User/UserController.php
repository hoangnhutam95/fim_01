<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function myMusic()
    {
        return view('user.music_detail.user');
    }

    public function edit()
    {
        $user = auth()->user();
        return view('user.music_detail.edit_profile', compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        $input = $request->only('name', 'address', 'phone', 'avatar', 'current_img');
        $user = $this->userRepository->update($input, auth()->user()->id);
        if (!$user) {
            return redirect()->action('User\UserController@myMusic')->with([
                'flash_level' => 'warning',
                'flash_message' => trans('user.user_update_fail'),
            ]);
        }

        return redirect()->action('User\UserController@myMusic')->with([
                'flash_level' => 'success',
                'flash_message' => trans('user.user_update_success'),
            ]);
    }
}
