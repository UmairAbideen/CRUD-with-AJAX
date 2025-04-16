<?php

use Illuminate\Support\Facades\Route;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Controllers\UserController;


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
    // Debugbar::info('This is a debug message.');
    // Debugbar::warning('This is a debug message.');
    // Debugbar::addMessage('This is a debug disajd message.');
    // Debugbar::startMeasure('This is a debug message.');

    return view('welcome');
});



Route::get('/users', [UserController::class, 'index']);


Route::post('/users/form/create', [UserController::class, 'create']);

Route::post('/users/edit', [UserController::class, 'edit']);

Route::post('/users/update', [UserController::class, 'update']);

Route::post('/users/delete', [UserController::class, 'delete']);
