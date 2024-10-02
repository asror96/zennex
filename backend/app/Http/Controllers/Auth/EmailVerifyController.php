<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Service\Auth\AuthService;
use Illuminate\Http\Request;

final class EmailVerifyController extends Controller
{
    public function __construct(
        private readonly AuthService $authService,
    ) {}

    public function __invoke(Request $request)
    {
        return $this->authService->verify($request);
    }
}
