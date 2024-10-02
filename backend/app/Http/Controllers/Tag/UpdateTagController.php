<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use App\Service\Tag\TagService;
use Illuminate\Http\JsonResponse;

final class UpdateTagController extends Controller
{
    public function __construct(
        private readonly TagService $tagService,
    ) {}

    public function __invoke(UpdateTagRequest $request, $id): TagResource|JsonResponse
    {
        $tag = Tag::query()->find($id);
        if ($tag === null) {
            return response()->json([
                'message' => 'Tag not found',
            ], 404);
        }
        $tag = $this->tagService->update($tag, $request->validated());

        return new TagResource($tag);

    }
}
