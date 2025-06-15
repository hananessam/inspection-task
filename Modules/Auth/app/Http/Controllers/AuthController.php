<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Auth\Services\AuthService;
use Modules\User\Transformers\UserResource;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(private AuthService $authService)
    {
    }

    /**
     * Handle the incoming request to register a new user.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = $this->authService->register($validated);

        if (!$user) {
            return response()->json([
                'message' => __('auth.registration_failed'),
            ], 500);
        }

        return response()->json([
            'message' => __('auth.registered'),
        ], 201);
    }

    /**
     * Login a user.
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $user = $this->authService->login($validated);
        if (!$user) {
            return response()->json([
                'message' => __('auth.invalid_credentials'),
            ], 401);
        }

        return response()->json([
            'message' => __('auth.logged_in'),
            'token' => $user['token'],
            'user' => new UserResource($user['user']),
        ]);
    }
}
