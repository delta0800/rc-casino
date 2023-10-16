<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\Services\AccountCreatedService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use Carbon\Carbon;

class LoginController extends BaseController
{
    public function login(Request $request, AccountCreatedService $account_created_service)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials)){ 
            $user = Auth::user(); 
            $user->tokens()->delete();

            if ($user->banned_till != null) {
                return $account_created_service->banned($user->banned_till);
            }
            
            $success['authorization'] = [
                'token' => $user->createToken('RoyalCasino')->plainTextToken,
                'type' => 'Bearer',
            ];
            $success['user_info'] =  new UserResource($user);
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'], 401);
        } 
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $user->update([
            'password' => $request->password,
            'password_changed_at' => Carbon::now()->toDateTimeString(),
        ]);
        $success['user_info'] =  new UserResource($user);
        return $this->sendResponse($success, 'Password changed successfully.');
    }

    public function user(Request $request)
    {
        return $this->sendResponse(new UserResource($request->user()), 'successfully.');
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->sendResponse(new UserResource($request->user()),'Logged out successfully');
    }
}
