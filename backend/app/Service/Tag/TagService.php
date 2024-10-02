<?php

declare(strict_types = 1);

namespace App\Service\Tag;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class TagService
{
    public function create($data): Model
    {

        return Tag::query()->create([
            'name' => $data['name'],
            'user_id' => auth()->id(),
        ]);
    }

    public function get(): Collection
    {
        return Tag::all();
    }

    public function update($tag, $data): Model
    {
        $tag->name = $data['name'];
        $tag->save();

        return $tag;
    }
}
