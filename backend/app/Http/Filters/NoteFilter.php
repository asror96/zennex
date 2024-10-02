<?php

declare(strict_types = 1);

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

final class NoteFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const CREATED_AT = 'created_at';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::CREATED_AT => [$this, 'created_at'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function created_at(Builder $builder, $value)
    {
        $builder->where('created_at', '<', $value);
    }
}
