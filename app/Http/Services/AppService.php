<?php

namespace App\Http\Services;

use App\Models\User;

class AppService
{
    /**
     * Доступные пункты меню для пользователя
     * 
     * @param \App\Models\User $user
     * @return array
     */
    public function getMenu(User $user)
    {
        return [
            [
                'route' => "/leads",
                'name' => "Заявки",
                'icon' => "th list",
            ],
            // [
            //     'route' => "/settings",
            //     'name' => "Настройки",
            //     'icon' => "setting",
            // ]
        ];
    }
}
