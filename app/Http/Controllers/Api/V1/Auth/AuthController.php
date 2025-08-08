<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService,
    )
    {
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        $entity = $request->entity();
        $token = $this->authService->registerUser($entity);
        return response()->json(['token' => $token]);
    }

    public function login(AuthUserRequest $request): JsonResponse
    {
        $entity = $request->entity();
        $token = $this->authService->createAuthToken($entity);
        return response()->json(['token' => $token]);
    }
}
