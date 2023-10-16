<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProviderRequest;
use App\Services\GameService;
use DataTables;

class GameController extends Controller
{
    public function index(Request $request, GameService $gameService)
    {
        $games = $gameService->gamesByProvider($request->provider_code);
        return view('backend.games.index', compact('games'));
    }
}
