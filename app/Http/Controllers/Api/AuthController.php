<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MiladRahimi\LaraJwt\Facades\JwtAuth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        
        if(Auth::guard('api')->attempt($credentials)) {
            $user = Auth::guard('api')->user();
            
            $jwt = JwtAuth::generateToken($user);
            
            return [
                'success' => true,
                'data' => ['user' => $user, 'token' => $jwt]
            ];
        } else {
            $message = "Invalid Credentials";

            return [
                'success' => false,
                'message' => $message
            ];
        }
    }

    public function logout() {
        Auth::guard('api')->logout();

        return [
            'success' => true,
        ];
    }

    public function signup(LoginRequest $request) {
        $user = User::create([
            'citizen_card' => $request->input('citizen_card'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return $this->login($request);
    }
}
