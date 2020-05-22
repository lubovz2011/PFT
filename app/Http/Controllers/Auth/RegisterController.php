<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'signup_login' => ['required', 'string', 'email', 'max:255', 'unique:users,login'],
            'signup_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]/*,
        [
            "signup_login.required" => "The login field is required.",
            "signup_login.email"    => "The login must be a valid email address.",
            "signup_login.unique"   => "The login has already been taken.",
            "signup_login.max"      => "The login may not be greater than 255 characters.",
            "signup_password.required"  => "The password field is required.",
            "signup_password.min"       => "The password must be at least 8 characters.",
            "signup_password.confirmed" => "The password confirmation does not match."
        ]*/);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'login' => $data['login'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
