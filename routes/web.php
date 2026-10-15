<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VolunteerApplicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/volunteer', [VolunteerController::class, 'index'])->name('volunteer.index');

// مسارات الزوار فقط
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

// يحتاج تسجيل دخول
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::post('/volunteer/{opportunity}/apply', [VolunteerController::class, 'apply'])->name('volunteer.apply');
});

// لوحة تحكم الأدمن - يحتاج تسجيل دخول + صلاحية أدمن
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', AdminProjectController::class)->except(['show']);

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');

    Route::get('/donations', [AdminDonationController::class, 'index'])->name('donations.index');

    Route::get('/volunteers', [VolunteerApplicationController::class, 'index'])->name('volunteers.index');
    Route::patch('/volunteers/{application}', [VolunteerApplicationController::class, 'update'])->name('volunteers.update');
});
