<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\TimetableController;
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

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('student')
        ->name('student.')
        ->group(function() {

        Route::get('timetable', [\App\Http\Controllers\Student\TimetableController::class, 'index'])
        ->name('timetable');

        Route::get('something', [\App\Http\Controllers\Student\TimetableController::class, 'index'])
        ->name('something');

    });

});


require __DIR__.'/auth.php';
