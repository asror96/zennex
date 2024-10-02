<?php

declare(strict_types = 1);

namespace App\Http\Resources\Tag;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

final class TagCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_map(static fn ($tags) => new TagResource($tags), $this->collection->all());
    }
}
