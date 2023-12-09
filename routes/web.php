<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('/roles', 'role')->name('role')->middleware(['role:pustakawan']);

    Route::prefix('/book')->as('book.')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::post('/create', [BookController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BookController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'], '/books/{id}', [BookController::class, 'update'])->name('update');
        Route::delete('/books/{id}', [BookController::class, 'delete'])->name('delete');
        Route::get('/print', [BookController::class, 'print'])->name('print');
    });
});

require __DIR__.'/auth.php';
