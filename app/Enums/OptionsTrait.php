<?php

namespace App\Enums;

use Illuminate\Support\Str;

trait OptionsTrait
{
    public static function options()
    {
        return collect(static::cases())
            ->map(fn ($case) => [
                'key' => $case->name,
                'text' => method_exists($case, 'name')
                    ? $case->name()
                    : Str::headline(Str::lower($case->name)),
                'value' => $case->value,
            ])
            ->all();
    }
}
