<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    protected function register(RegisterRequest $request)
    {
        try {
            $user = $this->userRepository->create($request->all());
            $this->guard()->login($user);

            return redirect()->action('User\HomeController@index')->with([
                'flash_level' => 'success',
                'flash_message' => trans('auth.create-user-succses'),
            ]);
        } catch (Exception $e) {
            return redirect()->route('login')->with([
                'flash_level' => 'warning',
                'flash_message' => trans('auth.create-user-fail'),
            ]);
        }
    }
}
