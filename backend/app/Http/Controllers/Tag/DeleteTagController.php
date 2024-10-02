<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

final class DeleteTagController extends Controller
{
    public function __invoke($id): JsonResponse
    {
        $tag = Tag::query()->find($id);
        if (! $tag) {
            return response()->json([
                'message' => 'Tag not found',
            ], 404);
        }
        $tag->delete();

        return response()->json([
            'message' => 'Tag deleted successfully',
        ], 200);
    }
}
