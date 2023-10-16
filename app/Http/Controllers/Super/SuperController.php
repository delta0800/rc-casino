<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\Senior;
use App\Models\Master;
use App\Models\Agent;
use App\Models\User;
use App\Models\SeniorTransaction;
use Illuminate\Support\Facades\Auth;

class SuperController extends Controller
{
    public function index(Request $request)
    {
        $count_senior = Senior::countusers();
        $count_master = Master::countusers();
        $count_agent = Agent::countusers();
        $count_user = User::countusers();

        $sum_senior = Senior::sumusers();
        $sum_master = Master::sumusers();
        $sum_agent = Agent::sumusers();
        $sum_user = User::sumusers();

        $deposits_senior = SeniorTransaction::deposits();
        $withdrawals_senior = SeniorTransaction::withdrawals();
        
        return view('supers.dashboard', compact(
            'count_senior', 
            'count_master', 
            'count_agent', 
            'count_user', 
            'sum_user',
            'sum_senior', 
            'sum_master', 
            'sum_agent', 
            'deposits_senior',
            'withdrawals_senior',
        ));
    }
}
