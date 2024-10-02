<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\LoginResource;
use App\Service\Auth\AuthService;

final class RefreshController extends Controller
{
    public function __construct(private readonly AuthService $authService) {}

    public function __invoke(): LoginResource
    {
        return new LoginResource($this->authService->refresh());
    }
}
