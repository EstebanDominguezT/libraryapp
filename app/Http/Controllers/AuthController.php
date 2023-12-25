<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required | string | email | max:255 | exists:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $credentials = request(['email', 'password']);
        $request_from = $request->is('api/*') ? 'api' : 'web';
        $jwt_token = ($request_from == 'api') ?  Auth::guard('api')->attempt($credentials) : Auth::attempt($credentials);

        if (!$jwt_token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Email or Password'
            ], 401);
        }
        
        return response()->json([
            'status' => 'success',
            'token' => $this->createToken($jwt_token)
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();
        
        return redirect('/login');
    }

    public function createToken($token) {

        $payload = [
            'sub' => Auth::guard('api')->user()->id,
            'iat' => time(),
            'exp' => Auth::guard('api')->factory()->getTTL() * 60,
            'name' => Auth::guard('api')->user()->name,
        ];
        
        $token = JWTAuth::fromUser(Auth::guard('api')->user(), $payload);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to create token'
            ], 500);
        }

        return $token;
    }

    public function refresh()
    {
        $currentToken = JWTAuth::getToken();
        
        return response()->json([
            'status' => 'success',
            'authorization' => [
                'token' => JWTAuth::refresh($currentToken)
            ]
        ]);
    }
}
