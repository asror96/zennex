<?php

declare(strict_types = 1);

namespace App\Service\Note;

use App\Models\Note;
use Illuminate\Database\Eloquent\Model;

final class NoteService
{
    public function create($data): Model
    {
        return Note::query()->create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => auth()->id(),
        ]);
    }
}
