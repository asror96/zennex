<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Service\Auth\AuthService;
use Illuminate\Auth\Events\Registered;

final class RegisterController extends Controller
{
    public function __construct(
        private readonly AuthService $authService,
    ) {}

    public function __invoke(RegisterRequest $request): RegisterResource
    {
        $user = $this->authService->register($request->validated());
        event(new Registered($user));

        return new RegisterResource($user);
    }
}
