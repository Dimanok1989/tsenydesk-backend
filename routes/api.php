<?php

use App\Http\Controllers\AppContoller;
use App\Http\Controllers\EmployeesContoller;
use App\Http\Controllers\Leads\LeadsController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('login', [AppContoller::class, 'login'])->name('api.user.login');
});

Route::get('leads/file/{file}', [LeadsController::class, "file"])
    ->name('api.leads.file')
    ->where('file', '.*');

Route::middleware('auth:api')->group(function () {
    Route::get('app', [AppContoller::class, 'show']);
    Route::resource('leads', LeadsController::class);
    Route::post('leads/{lead}/upload', [LeadsController::class, "upload"]);
    Route::get('employees/search', [EmployeesContoller::class, "search"]);
    Route::apiResource('employees', EmployeesContoller::class);
});
