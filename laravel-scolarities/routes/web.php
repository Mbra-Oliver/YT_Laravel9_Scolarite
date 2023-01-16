<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\LevelsController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolYearController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('niveaux')->group(function () {
        Route::get('/', [LevelsController::class, 'index'])->name('niveaux');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SchoolYearController::class, 'index'])->name('settings');
        Route::get('/create-school-year', [SchoolYearController::class, 'create'])->name('settings.create_school_year');

        Route::get('/create-level', [LevelsController::class, 'create'])->name('settings.create_levels');

        Route::get('/edit-level/{level}', [LevelsController::class, 'edit'])->name('settings.edit_level');
    });

    Route::prefix('classes')->group(function () {
        Route::get('/', [ClassController::class, 'index'])->name('classes');
        Route::get('/create', [ClassController::class, 'create'])->name('classes.create');
        Route::get('/edit/{classe}', [ClassController::class, 'edit'])->name('classes.edit');
    });
});

require __DIR__ . '/auth.php';
