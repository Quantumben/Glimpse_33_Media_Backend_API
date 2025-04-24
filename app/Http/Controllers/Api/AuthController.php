<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\Api\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthController extends BaseController
{
    public function __construct(private AuthService $authService)
    {
    }

    public function register(RegisterUserRequest $request): JsonResponse|AnonymousResourceCollection
    {
        $response = $this->authService->register($request->validated());

        return $this->resolveResponse($response);
    }

    public function login(LoginUserRequest $request): JsonResponse|AnonymousResourceCollection
    {
        $response = $this->authService->login($request->validated());

        return $this->resolveResponse($response);
    }
}
