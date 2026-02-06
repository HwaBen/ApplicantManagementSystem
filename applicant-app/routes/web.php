<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ParticipantController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/applicants/search', [ApplicantController::class, 'search'])
->name('applicants.search');

Route::get('/applicants/create', [ApplicantController::class, 'create'])
->name('applicants.create');

Route::get('/applicant/charts', [ApplicantController::class, 'charts'])
->name('applicants.charts');

Route::get('/applicants/{id}', [ApplicantController::class, 'show'])
->name('applicants.show');

Route::post('/applicants',[ApplicantController::class, 'store'])
->name('applicants.store');

Route::delete('/applicants/{id}', [ApplicantController::class, 'destroy'])
->name('applicants.destroy');

Route::get('/pariticipants/search', [ParticipantController::class, 'search'])
->name('participants.search');

Route::get('/participants/{id}', [ParticipantController::class, 'show'])
->name('participants.show');





