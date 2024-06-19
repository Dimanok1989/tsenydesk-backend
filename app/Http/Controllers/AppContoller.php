<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppContoller extends Controller
{
    public function show(Request $request)
    {
        return new AppResource($request->user());
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ["required", "email"],
            'password' => ["required", "string"],
        ]);

        if (!Auth::attempt($credentials)) {
            abort(403, "Неверный логин или пароль");
        }

        return new AppResource(Auth::user());
    }
}
