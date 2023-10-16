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
    'prefix' => 'sys-private',
    'controller' => 'LoginController'
],
function () {
    Route::get('admin', 'showAdminLoginForm')->name('login.admin');
    Route::post('admin', 'adminLogin')->name('admin.login');

    Route::get('super', 'showSuperLoginForm')->name('login.super');
    Route::post('super', 'superLogin')->name('super.login');

    Route::get('senior', 'showSeniorLoginForm')->name('login.senior');
    Route::post('senior', 'seniorLogin')->name('senior.login');

    Route::get('master', 'showMasterLoginForm')->name('login.master');
    Route::post('master', 'masterLogin')->name('master.login');

    Route::get('agent', 'showAgentLoginForm')->name('login.agent');
    Route::post('agent', 'agentLogin')->name('agent.login');
});

Route::group([
    'controller' => 'LoginController',
    'middleware' => 'auth:admin,super,senior,master,agent',
    'namespace' => 'Auth', 
], 
function() {
    Route::post('logout', 'logout')->name('logout');
});

Route::group([
    'controller' => 'ChangePasswordController',
    'namespace' => 'Auth', 
    'prefix' => 'sys-private',
    'middleware' => 'auth:admin,super,senior,master,agent',
], 
function() {
    Route::get('change-password', 'passwordExpired')->name('change.password');
    Route::post('change-password', 'changePassword')->name('password.change');
});

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => ['admin', 'password_expired'],
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

// Super Level
Route::group([
    'namespace' => 'Super',
    'prefix' => 'super',
    'middleware' => 'super',
],
function () {
    Route::get('dashboard', 'SuperController@index')->name('super.dashboard');
    Route::get('profile', 'SuperController@profile')->name('super.profile');

    Route::resource('seniors-lists', 'SeniorController');
    Route::get('restore-senior/{id}', 'SeniorController@restoreDeletedSenior');

    Route::get('masters', 'MasterController@index')->name('super.masters-lists');
    Route::get('agents', 'AgentController@index')->name('super.agents-lists');
    Route::get('users', 'UserController@index')->name('super.users-lists');

    // Route::get('master-transactions', 'TransactionController@masterTransaction')->name('master-transactions.index');
    // Route::get('agent-transactions', 'TransactionController@agentTransaction')->name('agent-transactions.index');
    // Route::get('user-transactions', 'TransactionController@userTransaction')->name('user-transactions.index');
});

// Senior Level
Route::group([
    'controller' => 'SeniorController',
    'namespace' => 'Senior',
    'prefix' => 'senior',
    'middleware' => 'senior',
],
function () {
    Route::get('dashboard', 'index')->name('senior.dashboard');
    Route::get('profile', 'profile')->name('senior.profile');
    Route::get('senior-transactions', 'seniorTransaction')->name('senior.senior-transactions');
});

// Master Level
Route::group([
    'controller' => 'MasterController',
    'namespace' => 'Master',
    'prefix' => 'master',
    'middleware' => 'master',
],
function () {
    Route::get('dashboard', 'index')->name('master.dashboard');
    Route::get('profile', 'profile')->name('master.profile');
    Route::get('agent-transactions', 'agentTransaction')->name('master.agent-transactions');
});

// Agent Level
Route::group([
    'controller' => 'AgentController',
    'namespace' => 'Agent',
    'prefix' => 'agent',
    'middleware' => 'agent',
],
function () {
    Route::get('dashboard', 'index')->name('agent.dashboard');
    Route::get('profile', 'profile')->name('agent.profile');
    Route::get('agent-transactions', 'agentTransaction')->name('agent.agent-transactions');
    Route::get('user-transactions', 'userTransaction')->name('agent.user-transactions');
    Route::post('user-transactions', 'storeUserTransaction')->name('user-transactions.store');
});