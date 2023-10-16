<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\Services\AccountCreatedService;
use Illuminate\Support\Facades\Hash;

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

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);
     
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user = $request->user();

        if ((Hash::check(request('old_password'), $user->password)) == false) {
            return $this->sendError('Validation Error.', ['error'=>'Check your old password.']);
        } else if ((Hash::check(request('new_password'), $user->password)) == true) {
            return $this->sendError('Validation Error.', ['error'=>'Please enter a password which is not similar then current password.']);
        } else {
            $user->tokens()->delete();
            $user->update(['password' => $validatedData['new_password']]);
            $success['user_info'] =  new UserResource($user);
            return $this->sendResponse($success, 'Password changed successfully.');
        }
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
