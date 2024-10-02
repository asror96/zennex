<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Filters\NoteFilter;
use App\Http\Requests\Note\FilterNoteRequest;
use App\Http\Resources\Note\NoteCollectionResource;
use App\Models\Note;

final class ReadNoteController extends Controller
{
    public function __invoke(FilterNoteRequest $request): NoteCollectionResource
    {
        $data = $request->validated();
        $filter = app()->make(NoteFilter::class, ['queryParams' => array_filter($data)]);
        $notes = Note::filter($filter)->paginate(10);

        return new NoteCollectionResource($notes);
    }
}
