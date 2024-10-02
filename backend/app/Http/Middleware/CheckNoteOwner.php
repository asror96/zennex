<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use App\Models\Note;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class CheckNoteOwner
{
    /**
     * Handle an incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Получаем ID заметки из маршрута
        $noteId = $request->route('note');

        // Получаем заметку
        $note = Note::find($noteId)->first();

        // Проверяем, существует ли заметка и принадлежит ли она текущему пользователю
        if (! $note || $note->user_id !== auth()->id()) {

            // Если заметка не найдена или не принадлежит пользователю, возвращаем 403 Forbidden
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Если все ок, пропускаем запрос дальше
        return $next($request);
    }
}
