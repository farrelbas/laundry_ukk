<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;



class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Generate token failed']);
        }

        return response()->json(['token' => $token]);
    }

    public function loginCheck()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'invalid token']);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredExceptions $e) {
            return response()->json(['message' => 'Token Expired']);
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidExceptions $e) {
            return response()->json(['message' => 'Invalid Token']);
        } catch (Tymon\JWTAuth\Exceptions\JWTExceptions $e) {
            return response()->json(['message' => 'Token Absent']);
        }

        return response()->json(['message' => 'Authentication Success!!']);
    }
}
