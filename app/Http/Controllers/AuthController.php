<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(AuthLoginRequest $request)
    {
        $validator = $request->validated();

        if (!$token = auth()->attempt($validator)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(AuthRegisterRequest $request)
    {
        $validator = $request->validated();

        $user = User::create(array_merge(
            $validator,
            ['password' => bcrypt($request->password)]
        ));

        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
