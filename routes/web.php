<?php

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

use App\Http\Controllers\{AuthController, createController, TaskController,EditController};
Route::get('/', function () {
    return view('index');
})->name('')->middleware('guest');

Route::get('/login', function () {
    return view('Auth.login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('Auth.inscription');
})->name('register')->middleware('guest');

Route::get('/dashboard',[TaskController::class, 'index'])->name('dashboard')->middleware('auth');

Route::post('/save', [AuthController::class, 'register']);
Route::post('/log', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/tasks', [createController::class, 'store'])->name('tasks.store')->middleware('auth');

Route::get('/tasks/search', [TaskController::class, 'search'])->middleware('auth');

Route::get('/tasks.edit/{id}', [EditController::class, 'index'])->name('tasks.edit')->middleware('auth');
Route::put('/tasks/{id}', [EditController::class, 'updateTask'])->name('tasks.update')->middleware('auth');
Route::patch('/tasks/{id}/desarchive', [TaskController::class, 'restore'])->name('tasks.desarchive')->middleware('auth');
Route::delete('/tasks/{id}/archive', [TaskController::class, 'archiveTask'])->name('tasks.archive')->middleware('auth');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.delete')->middleware('auth');

Route::patch('/tasks/{id}/update-statut', [TaskController::class, 'updateStatut'])->middleware('auth');
