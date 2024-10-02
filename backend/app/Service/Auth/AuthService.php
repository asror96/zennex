<?php

declare(strict_types = 1);

namespace App\Service\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

final class AuthService
{
    public function register($data): Model
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

    }

    public function verify(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            if (! $request->hasValidSignature()) {
                return redirect(env('APP_URL') . '/confirm-email?status=false&email=' . User::query()->find($request->route('id'))->email);
            }

            $user = User::find($request->route('id'));

            if ($user === null) {
                return redirect(env('APP_URL') . '/confirm-email?status=false&email=' . User::query()->find($request->route('id'))->email);
            }

            if ($user->hasVerifiedEmail()) {
                return redirect(env('APP_URL') . '/confirm-email?status=true&email=' . User::query()->find($request->route('id'))->email);
            }

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }

            return redirect(env('APP_URL') . '/confirm-email?status=true&email=' . User::query()->find($request->route('id'))->email);
        } catch (Throwable $e) {
            return redirect(env('APP_URL') . '/confirm-email?status=false');
        }
    }

    public function login($token): array
    {
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
    }

    public function refresh(): array
    {
        return $this->respondWithToken(auth()->refresh());
    }
}
