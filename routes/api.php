<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'namespace' => 'Api\V1',
    'controller' => 'LoginController',
], function () {
    Route::post('login', 'login');
});

Route::group([
    'namespace' => 'Api\V1',
    'controller' => 'LoginController',
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('logout', 'logout');
    Route::post('change-password', 'changePassword');
    Route::get('user', 'user');
});

Route::group([
    'namespace' => 'Api\V1',
    'controller' => 'GameClientController',
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('game-lists', 'gameListByProvider');
    Route::post('launch-games', 'launchGames');
    Route::post('create-member', 'createMember');
    Route::post('check-member', 'checkUsername');
    Route::post('get-balance', 'getUserBalance');
    Route::post('make-transfer', 'makeTransfer');
    // Route::post('agent-credits', 'balanceDue');
    Route::post('betting-logs', 'getBettings');
});

Route::group([
    'namespace' => 'Api\V1',
    'controller' => 'GameTypeController',
], function () {
    Route::get('game-types', 'gameTypes');
    Route::get('game-providers', 'gameProviders');
});
