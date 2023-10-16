<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\Senior;
use App\Models\Master;
use App\Models\Agent;
use App\Models\User;
use App\Services\GameService;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $count_super = Super::countusers();
        $count_senior = Senior::countusers();
        $count_master = Master::countusers();
        $count_agent = Agent::countusers();
        $count_user = User::countusers();

        $sum_super = Super::sumusers();
        $sum_senior = Senior::sumusers();
        $sum_master = Master::sumusers();
        $sum_agent = Agent::sumusers();
        $sum_user = User::sumusers();
        $game_service = new GameService();
        $provider_amount = $game_service->agentCredit();
        
        return view('admins.dashboard', compact(
            'count_super', 
            'count_senior', 
            'count_master', 
            'count_agent', 
            'count_user', 
            'sum_user',
            'sum_super', 
            'sum_senior', 
            'sum_master', 
            'sum_agent', 
            'provider_amount',
        ));
    }
}
