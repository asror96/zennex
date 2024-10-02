<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

final class ReadTagByIdController extends Controller
{
    public function __invoke($id): TagResource|JsonResponse
    {
        $tag = Tag::query()->find($id);
        if ($tag != null) {
            return new TagResource($tag);
        }

        return response()->json([
            'message' => 'Tag not found',
        ], 404);
    }
}
