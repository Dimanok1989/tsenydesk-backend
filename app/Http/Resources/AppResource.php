<?php

namespace App\Http\Resources;

use App\Http\Resources\User\UserResource;
use App\Http\Services\AppService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class AppResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'profile' => new UserResource($this->resource),
            'menu' => app(AppService::class)->getMenu($this->resource),
            $this->mergeWhen(
                $this->isAuth($request),
                $this->auth($this->resource)
            ),
        ];
    }

    private function auth(User $user)
    {
        return [
            'token' => $user->createToken("crm token")->accessToken
        ];
    }

    /**
     * Проверяет необходимость создания токена
     * 
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function isAuth(Request $request): bool
    {
        $current = $request->route()->getName();
        $names = [".user.login", ".user.registration"];

        foreach ($names as $name) {
            if (Str::endsWith($current, $name)) {
                return true;
            }
        }

        return false;
    }
}
