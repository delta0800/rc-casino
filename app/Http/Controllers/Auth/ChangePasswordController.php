<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Rules\SamePassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string', new MatchOldPassword,
            'new_password' => 'required|confirmed|string', new SamePassword, Password::min(8)
        ]);
        $user = Auth::user();
        $user->update(['password'=> $request->password]);
        return back()->with('success', 'Password Changed Successfully');
    }
}
