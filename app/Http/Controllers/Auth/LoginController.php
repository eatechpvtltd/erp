<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Traits\CommonScope;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use ViewHelper;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    //protected $redirectTo = '/';

    /*customize using role*/
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $data['general_setting'] = GeneralSetting::first();
        //return view('login.login');
        return view(('login.login'), compact('data'));

    }

    protected function credentials(Request $request)
    {
        return [$this->username() => $request->{$this->username()}, 'password' => $request->password, 'status' => 1];
    }


    // protected function authenticated(Request $request, $user)
    // {
    //     Auth::logoutOtherDevices($request->password);
    // }


}
