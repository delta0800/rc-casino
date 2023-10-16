<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:super')->except('logout');
        $this->middleware('guest:senior')->except('logout');
        $this->middleware('guest:master')->except('logout');
        $this->middleware('guest:agent')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::guard('admin')->attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect(RouteServiceProvider::ADMIN)->with('status', 'You are Logged in as Admin!');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function showSuperLoginForm()
    {
        return view('auth.login', ['url' => 'super']);
    }

    public function superLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::guard('super')->attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect(RouteServiceProvider::SUPER)->with('status', 'You are Logged in as Super!');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function showSeniorLoginForm()
    {
        return view('auth.login', ['url' => 'senior']);
    }

    public function seniorLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::guard('senior')->attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect(RouteServiceProvider::SENIOR)->with('status', 'You are Logged in as Senior!');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function showMasterLoginForm()
    {
        return view('auth.login', ['url' => 'master']);
    }

    public function masterLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::guard('master')->attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect(RouteServiceProvider::MASTER)->with('status', 'You are Logged in as Master!');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function showAgentLoginForm()
    {
        return view('auth.login', ['url' => 'agent']);
    }

    public function agentLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::guard('agent')->attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect(RouteServiceProvider::AGENT)->with('status', 'You are Logged in as Agent!');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        switch ($this->guardName()) {
            case 'admin':
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.admin'))->with('status', 'You have been successfully logged out!');
                break;
            
            case 'super':
                Auth::guard('super')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.super'))->with('status', 'You have been successfully logged out!');
                break;

            case 'senior':
                Auth::guard('senior')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.senior'))->with('status', 'You have been successfully logged out!');
                break;

            case 'master':
                Auth::guard('master')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.master'))->with('status', 'You have been successfully logged out!');
                break;
            default:
                Auth::guard('agent')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.agent'))->with('status', 'You have been successfully logged out!');
                break;
        }
    }

    public function passwordExpired()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $user->update([
            'password'=> $request->password,
            'password_changed_at' => Carbon::now()->toDateTimeString()
        ]);
        switch ($this->guardName()) {
            case 'admin':
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.admin'))->with('status', 'Password changed successfully, You can now login !');
                break;
            
            case 'super':
                Auth::guard('super')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.super'))->with('status', 'Password changed successfully, You can now login !');
                break;

            case 'senior':
                Auth::guard('senior')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.senior'))->with('status', 'Password changed successfully, You can now login !');
                break;

            case 'master':
                Auth::guard('master')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.master'))->with('status', 'Password changed successfully, You can now login !');
                break;
            default:
                Auth::guard('agent')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.agent'))->with('status', 'Password changed successfully, You can now login !');
                break;
        }
    }

    public function guardName()
    {
        $guards = array_keys(config('auth.guards'));
        foreach($guards as $guard){
            if(auth()->guard($guard)->check()){
                return $guard;
            }
        }
    }
}
