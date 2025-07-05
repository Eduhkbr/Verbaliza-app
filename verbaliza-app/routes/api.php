<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\EmailVerificationController;

/* Rotas de Autenticação Públicas */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rota para reenviar o e-mail
Route::post('/email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('throttle:6,1');

// Rota que o utilizador clica no e-mail
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

/* Rotas que Requerem Autenticação */
Route::middleware('auth:sanctum', 'verified')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/projects', [ProjectController::class, 'store']);
});
