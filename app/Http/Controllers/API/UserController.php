<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required' 
            ]);

            // $credentials = $request(['email', 'password']);

            // return $credentials;

            if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return ResponseFormatter::error([
                    'messages' => 'Unatuhorized'
                ], 'Authentication Failed', 500);
            }

            $user = User::where('email', $request->email)->first();

            // return $user;

            if(!Hash::check($request->password, $user->password)){
                throw new \Exception('Invalid Credentials');
            }

            $token = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' =>$token,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated');
        } catch (\Exception $th) {
            return ResponseFormatter::error([
                'messages' => 'Something wrong',
                'error' => $th->getMessage(),
            ], 'Authentication Failed', 500);
        }
    }

    public function register(Request $request)
    {
        try{
            // return $request;
            $user = [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ];
            User::create($user);
    
            return ResponseFormatter::success([
                'user' => $user
            ], 'Authenticated');
        }catch(\Exception $th) {
            return ResponseFormatter::error([
                'messages' => 'Something wrong',
                'error' => $th->getMessage(),
            ], 'Authentication Failed', 500);
        }
    }
}

