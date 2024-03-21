<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'upload']);
});
