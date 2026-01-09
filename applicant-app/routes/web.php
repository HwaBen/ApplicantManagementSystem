<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ParticipantController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [ParticipantController::class, 'search'])->name('participants.search');

Route::get('/participants/create', [ParticipantController::class, 'create'])->name('participants.create');
;

Route::get('/participants/{id}', [ParticipantController::class, 'show'])
    ->name('participants.show');






