<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\CreateRequest;
use App\Http\Resources\Note\CreateResource;
use App\Service\Note\NoteService;
use Illuminate\Http\JsonResponse;

final class CreateNoteController extends Controller
{
    public function __construct(
        private readonly NoteService $noteService,
    ) {}

    public function __invoke(CreateRequest $request): JsonResponse
    {
        return (new CreateResource($this->noteService->create($request->validated())))
            ->response()
            ->setStatusCode(201);
    }
}
