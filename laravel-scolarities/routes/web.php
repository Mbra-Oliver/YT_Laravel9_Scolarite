<?php

use App\Http\Controllers\AttributionController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\LevelsController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\StudentController;
use App\Mail\HelloMail;
use Illuminate\Support\Facades\Mail;
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

    //ROutes pour intérragir avec les élèves

    Route::prefix('eleves')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students');
        Route::get('/create', [StudentController::class, 'create'])->name('students.create');
        Route::get('/edit/{student}', [StudentController::class, 'edit'])->name('students.edit');
        Route::get('/{student}', [StudentController::class, 'show'])->name('students.show');
    });

    Route::prefix('inscriptions')->group(function () {
        Route::get('/', [AttributionController::class, 'index'])->name('inscriptions');
        Route::get('/create', [AttributionController::class, 'create'])->name('inscriptions.create');
        Route::get('/edit/{attribution}', [AttributionController::class, 'edit'])->name('inscriptions.edit');
    });

    Route::prefix('payments')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('payments');
        Route::get('/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::get('/edit/{payment}', [PaymentController::class, 'edit'])->name('payments.edit');
    });


    Route::prefix('parents')->group(function () {
        Route::get('/', [ParentController::class, 'index'])->name('parents');
        Route::get('/create', [ParentController::class, 'create'])->name('parents.create');
    });


    Route::prefix('frais')->group(function () {
        Route::get('/', [FeesController::class, 'index'])->name('fees');
        Route::get('/create', [FeesController::class, 'create'])->name('fees.create');
        Route::get('/edit/{fee}', [FeesController::class, 'edit'])->name('fees.edit');
    });
});

require __DIR__ . '/auth.php';
