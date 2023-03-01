<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});





// Route group
Route::middleware(['auth', 'verified'])->group(function() {
    Route::middleware('role:1')
        ->prefix('student')
        ->name('student.')
        ->group(function() {

        Route::get('timetable', [\App\Http\Controllers\Student\TimetableController::class, 'index'])
        ->name('timetable');

        // Route::get('something', [\App\Http\Controllers\Student\TimetableController::class, 'index'])
        // ->name('something');

    });

    Route::middleware('role:2')
        ->prefix('teacher')
        ->name('teacher.')
        ->group(function() {

        Route::get('timetable', [\App\Http\Controllers\Teacher\TimetableController::class, 'index'])
        ->name('timetable');

        // Route::get('something', [\App\Http\Controllers\Student\TimetableController::class, 'index'])
        // ->name('something');

    });

    Route::middleware('role:3')
        ->prefix('admin')
        ->name('admin.')
        ->group(function() {

        Route::get('users', [Admin\UsersController::class, 'index'])
        ->name('users');

        // Route::get('something', [\App\Http\Controllers\Student\TimetableController::class, 'index'])
        // ->name('something');

    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


require __DIR__.'/auth.php';
