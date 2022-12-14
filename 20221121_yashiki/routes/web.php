<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Models\Todo;

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

Route::get('/home', [TodoController::class, 'index'])->middleware(['auth']);
Route::post('/add', [TodoController::class, 'add']);
Route::post('/update/{id}', [TodoController::class, 'update']);
Route::post('/delete/{id}', [TodoController::class, 'delete']);
Route::get('/search', [TodoController::class, 'keyword']);
Route::post('/search', [TodoController::class, 'search']);
Route::get('/return', [TodoController::class, 'return']);
Route::get('/logout', [TodoController::class, 'logout']);



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
