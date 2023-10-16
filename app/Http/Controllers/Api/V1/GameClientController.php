<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Services\GameService;
use App\Http\Requests\CreateProviderRequest;

class GameClientController extends BaseController
{
    protected $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function gameListByProvider(CreateProviderRequest $request)
    {
        $response = $this->gameService->gamesByProvider($request->provider_code);
        return $this->sendResponse($response, 'successfully');  
    }

    public function launchGames(CreateProviderRequest $request)
    {
        $response = $this->gameService->launchGame($request);
        return $this->sendResponse($response, 'successfully');  
    }

    public function makeTransfer(Request $request)
    {
        $response = $this->gameService->transferUserBalance($request);
        return $this->sendResponse($response, 'successfully.');  
    }

    public function getUserBalance(Request $request)
    {
        $response = $this->gameService->getBalance($request->provider_code);
        return $this->sendResponse($response, 'successfully.');  
    }

    public function createMember(Request $request)
    {
        $response = $this->gameService->memberCreate();
        return $this->sendResponse($response, 'successfully.');  
    }

    public function getBalance(Request $request)
    {
        $response = $this->gameService->memberCreate();
        return $this->sendResponse($response, 'successfully.');  
    }

    public function balanceDue(Request $request)
    {
        $response = $this->gameService->agentCredit();
        return $this->sendResponse($response, 'successfully.');  
    }

    public function getBettings(Request $request)
    {
        $response = $this->gameService->bettingLogs();
        $response = json_decode($response['result']);
        return $this->sendResponse($response, 'successfully');  
    }
}
