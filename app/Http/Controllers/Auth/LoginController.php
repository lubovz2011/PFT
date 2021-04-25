<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    */

    /**
     * This trait gives us user authorization functionality
     */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance(object).
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username(email) to be used by the controller.
     * @return string
     */
    public function username()
    {
        return 'login';
    }

    /**
     * Method validate the user login request.
     * @param  \Illuminate\Http\Request  $request
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'bail|required|email|max:255',
            'password'        => 'bail|required|string|min:8',
        ]);
    }

    /**
     * Redirect the user to the Provider authentication page(Facebook/Google).
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Provider
     * and login the user using social network data
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        //get user data from social network (google/facebook)
        $socialUser = Socialite::driver($provider)->user();
        //flag that tell us if user is new user or existing user
        $isNew = false;

        try {
            $user = User::where('login', '=', $socialUser->getEmail())
                        ->where('login_type', '=', $provider)->firstOrFail();
        }
        catch (\Exception $e) {
            try{
                $user = User::create([
                    'login' => $socialUser->getEmail(),
                    'login_type' => $provider,
                    'name' => $socialUser->getName(),
                    'password' => Hash::make(Str::random(24)),
                    'email_verified_at' => Carbon::now()
                ]);
                $isNew = true;
            }
            catch (\Exception $e){
                return redirect()->route('welcome')
                    ->withErrors(['signup_login' => 'This email has already been taken.']);
            }
        }

        Auth::login($user, true);
        return redirect()->route($isNew ? 'settings' : 'reports');
    }
}
