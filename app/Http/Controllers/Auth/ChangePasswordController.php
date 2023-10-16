<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
    public function passwordExpired()
    {
        return view('auth.change-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        $user->update([
            'password'=> $request->password,
            'password_changed_at' => Carbon::now()->toDateTimeString()
        ]);
        switch ($this->guardName()) {
            case 'admin':
                auth()->guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.admin'))->with('status', 'Password changed successfully, You can now login !');
                break;
            
            case 'super':
                auth()->guard('super')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.super'))->with('status', 'Password changed successfully, You can now login !');
                break;

            case 'senior':
                auth()->guard('senior')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.senior'))->with('status', 'Password changed successfully, You can now login !');
                break;

            case 'master':
                auth()->guard('master')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->guest(route('login.master'))->with('status', 'Password changed successfully, You can now login !');
                break;
            default:
                auth()->guard('agent')->logout();
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
