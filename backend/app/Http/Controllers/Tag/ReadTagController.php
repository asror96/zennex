<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagCollectionResource;
use App\Service\Tag\TagService;

final class ReadTagController extends Controller
{
    public function __construct(
        private readonly TagService $tagService,
    ) {}

    public function __invoke(): TagCollectionResource
    {
        $tags = $this->tagService->get();

        return new TagCollectionResource($tags);
    }
}
