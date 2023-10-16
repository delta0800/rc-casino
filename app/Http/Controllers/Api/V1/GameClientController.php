<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Services\GameService;
use App\Http\Requests\CreateProviderRequest;
use App\Http\Requests\MakeTransferRequest;

class GameClientController extends BaseController
{
    protected $gameService;
    protected $username;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
        $this->username = auth()->guard('sanctum')->user()->username;
    }

    public function checkUsername(CreateProviderRequest $request)
    {
        $provider_code = $request->provider_code;
        $response = $this->gameService->checkMember($provider_code, $this->username);
        return $this->sendResponse($response, 'successfully.');  
    }

    public function createMember(Request $request)
    {
        $response = $this->gameService->memberCreate($this->username);
        return $this->sendResponse($response, 'successfully.');  
    }

    public function makeTransfer(MakeTransferRequest $request)
    {
        $amount = $request->amount;
        $type = $request->type;
        $provider_code = $request->provider_code;

        $response = $this->gameService->transferUserBalance($amount, $type, $provider_code, $this->username);
        return $this->sendResponse($response, 'successfully.');  
    }

    public function launchGames(CreateProviderRequest $request)
    {
        $type = $request->type;
        $provider_code = $request->provider_code;

        $response = $this->gameService->launchGame($provider_code, $type, $this->username);
        return $this->sendResponse($response, 'successfully');  
    }

    public function getUserBalance(Request $request)
    {
        $provider_code = $request->provider_code;

        $response = $this->gameService->getBalance($provider_code, $this->username);
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

    public function gameListByProvider(CreateProviderRequest $request)
    {
        $provider_code = $request->provider_code;
        $response = $this->gameService->gamesByProvider($provider_code);
        return $this->sendResponse($response, 'successfully');  
    }
}
