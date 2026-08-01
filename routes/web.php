<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;

Route::get('/', fn (): array => [config('app.name')]);

Route::prefix('api')->name('api.')->group(function (): void {
    Route::get('/habits', [HabitController::class, 'index'])->name('habits.index');
    Route::get('/habits/{habit:uuid}', [HabitController::class, 'show'])->name('habits.show');
    Route::post('/habits', [HabitController::class, 'store'])->name('habits.store');
});