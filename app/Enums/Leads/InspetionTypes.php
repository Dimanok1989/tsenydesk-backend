<?php

namespace App\Enums\Leads;

use App\Enums\OptionsTrait;

enum InspetionTypes: int
{
    use OptionsTrait;

    case formalization = 1;
    case technical = 2;
    case price = 3;

    public function name()
    {
        return match ($this) {
            static::formalization => "Документы правильные?",
            static::technical => "Данные по замеру ок?",
            static::price => "Фото объекта ок?",
        };
    }
}
