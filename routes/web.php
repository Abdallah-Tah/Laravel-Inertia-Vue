<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/topics/', [\App\Http\Controllers\TopicsController::class, 'index'])->name('topics.index');
Route::get('/topics/create/', [\App\Http\Controllers\TopicsController::class, 'create'])->name('topics.create');
Route::post('/topics/', [\App\Http\Controllers\TopicsController::class, 'store'])->name('topics.store');
Route::get('/topics/{topics}/', [\App\Http\Controllers\TopicsController::class, 'show'])->name('topics.show');
Route::get('/topics/{topic}/edit/', [\App\Http\Controllers\TopicsController::class, 'edit'])->name('topics.edit');
Route::put('/topics/{topic}/', [\App\Http\Controllers\TopicsController::class, 'update'])->name('topics.update');
Route::delete('/topics/{topic}/', [\App\Http\Controllers\TopicsController::class, 'destroy'])->name('topics.destroy');



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
