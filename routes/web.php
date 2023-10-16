<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'namespace' => 'Auth',
    'prefix' => 'sys-private'
],
function () {
    Route::get('admin', 'LoginController@showAdminLoginForm')->name('login.admin');
    Route::post('admin', 'LoginController@adminLogin')->name('admin.login');

    Route::get('super', 'LoginController@showSuperLoginForm')->name('login.super');
    Route::post('super', 'LoginController@superLogin')->name('super.login');

    Route::get('senior', 'LoginController@showSeniorLoginForm')->name('login.senior');
    Route::post('senior', 'LoginController@seniorLogin')->name('senior.login');

    Route::get('master', 'LoginController@showMasterLoginForm')->name('login.master');
    Route::post('master', 'LoginController@masterLogin')->name('master.login');

    Route::get('agent', 'LoginController@showAgentLoginForm')->name('login.agent');
    Route::post('agent', 'LoginController@agentLogin')->name('agent.login');
});

Route::group([
    'middleware' => 'auth:admin,super,senior,master,agent',
    'namespace' => 'Auth', 
], 
function() {
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::post('change-password', 'ChangePasswordController@changePassword')->name('password.change');
});

Route::group([
    'middleware' => 'admin',
    'namespace' => 'Admin',
    'prefix' => 'admin',
],
function () {
    Route::get('dashboard', 'AdminController@index')->name('dashboard.index');
    
    // Partners
    Route::resource('supers', 'SuperController');
    Route::get('restore-super/{id}', 'SuperController@restoreDeletedSuper');
    Route::get('seniors', 'SeniorController@index')->name('seniors.index');
    Route::get('masters', 'MasterController@index')->name('masters.index');
    Route::get('agents', 'AgentController@index')->name('agents.index');
    Route::get('users', 'UserController@index')->name('users.index');

    // Transaction Lists
    Route::resource('super-transactions', 'TransactionController');
    Route::get('senior-transactions', 'TransactionController@seniorTransaction')->name('senior-transactions.index');
    Route::get('master-transactions', 'TransactionController@masterTransaction')->name('master-transactions.index');
    Route::get('agent-transactions', 'TransactionController@agentTransaction')->name('agent-transactions.index');
    Route::get('user-transactions', 'TransactionController@userTransaction')->name('user-transactions.index');

    // Games
    Route::get('game-types','GameTypeController@index')->name('game-types.index');
    Route::get('game-lists','GameController@index')->name('game-lists.index');
    Route::resource('game-providers','GameProviderController');
    Route::get('game-providerStatus', 'GameProviderController@changeProviderStatus')->name('provider.changeStatus');
    Route::get('bettings','BettingController@index')->name('bettings.index');
});