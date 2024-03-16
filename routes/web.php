<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;

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

Route::fallback(function () {
    return view('errors.404');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return to_route('login');
});


Route::group(["middleware" => "auth"], function () {
    Route::resource('user', UserController::class);
    Route::resource('event', EventController::class);
    Route::resource('participant', ParticipantController::class);
});
