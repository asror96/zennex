<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\LogoutResource;

final class LogoutController extends Controller
{
    public function __construct() {}

    public function __invoke(): LogoutResource
    {
        auth()->logout();

        return new LogoutResource(true);
    }
}
