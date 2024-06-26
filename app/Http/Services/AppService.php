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
                'name' => "Замеры",
                'icon' => "clipboard list",
            ],
            // [
            //     'route' => "/settings",
            //     'name' => "Настройки",
            //     'icon' => "setting",
            // ]
        ];
    }
}
