<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\UpdateNoteRequest;
use App\Http\Resources\Note\NoteResource;
use App\Models\Note;

final class UpdateNoteController extends Controller
{
    public function __invoke(UpdateNoteRequest $request, Note $note): NoteResource
    {
        $note->update($request->validated());

        return new NoteResource($note);
    }
}
