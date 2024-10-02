<?php

declare(strict_types = 1);

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class LoginResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'access_token' => $this['access_token'],
            'token_type' => $this['token_type'],
            'expires_in' => $this['expires_in'],
        ];
    }
}
