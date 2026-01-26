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

use App\Http\Controllers\{AuthController,TaskController};
Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('Auth.login');
});

Route::get('/register', function () {
    return view('Auth.inscription');
});

Route::get('/dashboard', [TaskController::class, 'index'])->middleware('auth');
Route::post('/save', [AuthController::class, 'register']);
Route::post('/log', [AuthController::class, 'login']);