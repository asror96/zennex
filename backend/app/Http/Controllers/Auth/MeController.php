<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\MeResource;

final class MeController extends Controller
{
    public function __construct() {}

    public function __invoke(): MeResource
    {
        return new MeResource(auth()->user());
    }
}
