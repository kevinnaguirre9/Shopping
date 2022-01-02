<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MiladRahimi\LaraJwt\Facades\JwtAuth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        
        if(Auth::guard('api')->attempt($credentials)) {
            $user = Auth::guard('api')->user();
            
            $jwt = JwtAuth::generateToken($user);
            
            return [
                'error' => false,
                'data' => ['token' => $jwt]
            ];
        } else {
            $error = true;
            $message = "Invalid Credentials";

            return [
                'error' => $error, 
                'message' => $message
            ];
        }
    }
}
