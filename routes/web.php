<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GroupController;
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

require __DIR__.'/auth.php';

Route::group(["middleware" => "auth"], function () {

    Route::get('/', function () {
        return to_route('event.index');
    });

    Route::fallback(function () {
        return view('errors.404');
    });

    Route::resource('user', UserController::class)->except(['index', 'create', 'store', 'edit']);
    Route::delete('destroy-account', [UserController::class, 'destroyAccount'])->name('user.destroyAccount');

    Route::resource('event', EventController::class)->except(['create']);
    Route::get('event/{event}/groups', [EventController::class, 'groupsPage'])->name('event.show.groups');
    Route::get('event/{event}/participants', [EventController::class, 'participantsPage'])->name('event.show.participants');
    Route::post('event/{event}/participants/add', [EventController::class, 'addParticipants'])->name('event.participants.add');
    Route::post('event/{event}/participants/expel', [EventController::class, 'expelParticipants'])->name('event.participants.expel');
    Route::post('event/{event}/participants/create_add', [EventController::class, 'createAndAddParticipant'])->name('event.participants.create_add');

    Route::resource('participant', ParticipantController::class)->except(['create', 'edit']);

    Route::get('group/{event}/generate', [GroupController::class, 'generate'])->name('groups.generate');
});
