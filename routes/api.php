<?php

use App\Http\Controllers\Api\TiktokWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/tiktok/webhook', [TiktokWebhookController::class, 'handle'])->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
