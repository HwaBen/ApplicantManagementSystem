<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

     // 🔹 Super Admin routes
    Route::middleware('role:super_admin')->group(function () {

        Route::get('/superadmin/dashboard', function () {
            return view('dashboards.superadmin');
        })->name('superadmin.dashboard');

        Route::get('/admin/users', [UserManagementController::class, 'index'])
            ->name('users.index');

        Route::get('/admin/users/create', [UserManagementController::class, 'create'])
            ->name('users.create');

        Route::post('/admin/users', [UserManagementController::class, 'store'])
            ->name('users.store');

        Route::get('/admin/users/{user}/edit', [UserManagementController::class, 'edit'])
            ->name('users.edit');

        Route::put('/admin/users/{user}', [UserManagementController::class, 'update'])
            ->name('users.update');

        Route::delete('/admin/users/{user}', [UserManagementController::class, 'destroy'])
            ->name('users.destroy');

    });


    // Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('dashboards.admin');
        })->name('admin.dashboard');
    });

    // User
    Route::middleware('role:user')->group(function () {
        Route::get('/user/dashboard', function () {
            return view('dashboards.user');
        })->name('user.dashboard');
    });

});


Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

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





