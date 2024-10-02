<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagRequest;
use App\Http\Resources\Tag\CreateTagResource;
use App\Service\Tag\TagService;

final class CreateTagController extends Controller
{
    public function __construct(
        private readonly TagService $tagService,
    ) {}

    public function __invoke(TagRequest $request): CreateTagResource
    {
        $tag = $this->tagService->create($request->validated());

        return new CreateTagResource($tag);
    }
}
