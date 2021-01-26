<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * This class handle user commands on settings
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Method returns settings page
     * @return \Illuminate\View\View
     */
    public function displaySettingsPage(Request $request){
        $user = auth()->user();

        $params = [
            "login"         => $user->login,
            "name"          => $user->name,
            "userName"      => $user->name ?: $user->login,
            "dateFormat"    => $user->date_format,
            "limit"         => $user->limit,
            "mainCurrency"  => $user->currency,
            "currencies"    => explode(',', $user->currencies ?: ""),
            "socialLogin"   => $user->login_type !== 'email',
            "monthlyReport" => (bool)$user->monthly_report
        ];
        return view('settings.settings', $params);
    }

    /**
     * Method update personal info of user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editPersonalInfo(Request $request)
    {
        $user = auth()->user();
        $ifEmailLogin = $user->login_type === 'email';
        $additionalLoginValidation = '';
        if($user->login != $request->input('login'))
        {
            $additionalLoginValidation = '|unique:users,login';
            if($ifEmailLogin)
                $additionalLoginValidation = '|required';
        }
        $this->validate($request, [
            'name'  => 'string|max:255|nullable',
            'login' => 'bail|email|max:255'.$additionalLoginValidation
        ]);
        $user->name = $request->input("name");
        if($ifEmailLogin)
            $user->login = $request->input("login");
        $user->save();

        return redirect()->route("settings");
    }

    /**
     * Method update interface settings of user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editInterface(Request $request){
        $user = auth()->user();
        $this->validate($request, [
            'date_format'   => 'bail|required|in:Y/m/d,m/d/Y,d/m/Y,d.m.Y,d-m-Y',
            'limit'         => 'bail|required|in:10,20,25,50,100',
            'main_currency' => 'bail|required|in:ILS,USD,EUR,GBP,JPY',
            'currencies.*'  => 'bail|required|in:ILS,USD,EUR,GBP,JPY'
        ]);
        $user->date_format = $request->input("date_format");
        $user->limit = $request->input("limit");
        $user->currency = $request->input("main_currency");
        $user->currencies = implode(",", $request->input("currencies") ?: []);

        $user->save();
        return redirect()->route("settings");
    }

    /**
     * Method for updating user password
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editSecurity(Request $request){
        $user = auth()->user();
        $this->validate($request, [
            'password'  => 'bail|required|min:8|string|confirmed'
        ]);
        $user->password = Hash::make($request->input("password"));

        $user->save();
        return redirect()->route("settings");
    }

    /**
     * Method for updating monthly report agreement
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editEmailNotifications(Request $request){
        $user = auth()->user();

        $user->monthly_report = $request->input("monthly_report") == "on";

        $user->save();
        return redirect()->route("settings");
    }

    /**
     * Method delete user profile from DB
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteProfile(){
        /** @var User $user */
        $user = auth()->user();
        auth()->logout();
        $user->delete();
        return redirect()->route('welcome');
    }
}
