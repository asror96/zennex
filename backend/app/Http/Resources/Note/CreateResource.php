<?php

declare(strict_types = 1);

namespace App\Http\Resources\Note;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
