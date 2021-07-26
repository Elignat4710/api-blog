<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Repository\Interfaces\UserRepositoryInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected $userRep;

    public function __construct(UserRepositoryInterface $userRep)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);

        $this->userRep = $userRep;
    }

    public function login(AuthLoginRequest $request) : JsonResponse
    {
        $validator = $request->validated();

        if (!$token = auth()->attempt($validator)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!auth()->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Confirmed email']);
        }

        return $this->respondWithToken($token);
    }

    public function register(AuthRegisterRequest $request) : JsonResponse
    {
        $validator = $request->validated();

        $user = $this->userRep->create(array_merge(
            $validator,
            ['password' => bcrypt($request->password)]
        ));

        event(new Registered($user));

        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    public function logout() : JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => "Successfully logged out"]);
    }

    protected function respondWithToken($token) : JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
