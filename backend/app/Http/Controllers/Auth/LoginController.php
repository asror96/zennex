<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Service\Auth\AuthService;

final class LoginController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['__invoke']]);
    }

    public function __invoke(LoginRequest $request): LoginResource|\Illuminate\Http\JsonResponse
    {
        $credentials = $request->validated();
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $response = $this->authService->login($token);

        return new LoginResource($response);
    }
}
