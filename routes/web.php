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

Route::fallback(function () {
    return view('errors.404');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return to_route('login');
});


// Route::group(["middelware" => "auth"], function () {
//     Route::get('/', function () {
//         return view('layouts.app');
//     });
// });
