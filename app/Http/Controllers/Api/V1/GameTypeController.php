<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\GameTypeResource;
use App\Http\Resources\GameProviderResource;
use App\Models\GameType;
use App\Models\GameProvider;

class GameTypeController extends BaseController
{
    public function gameTypes(Request $request)
    {
        $data = GameType::get();
        $result = GameTypeResource::collection($data);
        return $this->sendResponse($result, 'Game type lists retrieved successfully.');  
    }

    public function gameProviders(Request $request)
    {
        $data = GameProvider::get();
        $result = GameProviderResource::collection($data);
        return $this->sendResponse($result, 'Game proveder lists retrieved successfully.');  
    }
}
