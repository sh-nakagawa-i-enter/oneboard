<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\FavoritesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BoardController::class, 'index']);

Route::get('/dashboard', [BoardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    //お気に入り機能FavoritesController
    Route::prefix('board/{id}')->group(function() {
        Route::post('favorite', [FavoritesController::class, 'store'])->name('favorites.favorite');
        Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('favorites.unfavorite');
    });
    
    // 制限された機能のルートを定義する
    Route::resource('favorites', FavoritesController::class, ['only' => ['index']]);
    Route::resource('board', BoardController::class);
    Route::put('board/{id}', [BoardController::class, 'update'])->name('board.update');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/
require __DIR__.'/auth.php';
