<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\JsonResponse;

final class DeleteNoteController extends Controller
{
    public function __invoke(Note $note): JsonResponse
    {
        $note->delete();

        return response()->json(['message' => 'Note deleted successfully'], 200);
    }
}
