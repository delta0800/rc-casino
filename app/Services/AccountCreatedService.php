<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;

class AccountCreatedService
{
    public function ban($banned_till)
    {
        switch ($banned_till) {
            case 'ban_for_next_7_days':
                $ban = Carbon::now()->addDays(7);
                break;

            case 'ban_for_next_14_days':
                $ban = Carbon::now()->addDays(14);
                break;

            default:
                $ban = 0;
                break;
        }
        return $ban;
    }

    public function banned($banned_till)
    {
        switch ($banned_till) {
            case '0':
                return response()->json([
                        'success' => false,
                        'message' => 'Unauthorised',
                        'error' => 'Your account has been banned permanently.',
                    ], 403);
                break;
            
            default:
                $banned_days = now()->diffInDays($banned_till) + 1;
                return response()->json([
                        'success' => false,
                        'message' => 'Unauthorised',
                        'error' => 'Your account has been suspended for '.$banned_days.' '.Str::plural('day', $banned_days),
                    ], 403);
                break;
        }
    }

    public function username()
    {
        switch ($this->guardName()) {
            case 'admin':
                return 'SU'.str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
                break;
            
            case 'super':
                return 'SE'.str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
                break;

            case 'senior':
                return 'MS'.str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
                break;

            case 'master':
                return 'AG'.str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
                break;
                
            default:
                return str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
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