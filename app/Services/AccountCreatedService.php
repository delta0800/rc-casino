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
        return 'SU'.str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    }
}