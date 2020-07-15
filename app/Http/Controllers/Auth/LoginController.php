<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;
    const EMAIL = 'guest@guest.com';
    const PASSWORD = 'password';

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
     * ゲストログイン
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate()
    {
      if (Auth::attempt(['email' => self::EMAIL, 'password' => self::PASSWORD])) {
        return redirect('/');
      }
      return back();
    }

    /**
     * ログアウト後遷移
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function loggedOut()
    {
      return redirect(route('post.index'));
    }
}
