<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCitizenController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminRewardController;
use App\Http\Controllers\Citizen\CitizenDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // Role User/Citizen
    Route::middleware('role:citizen')->group(function () {

        Route::get('/dashboard', [CitizenDashboardController::class, 'index'])->name('citizen.dashboard');
    });


    // Role Super Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::middleware('role:super_admin')->group(function () {

            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

            Route::resource('categories', AdminCategoryController::class);

            Route::resource('reports', AdminReportController::class);
            Route::put('/reports/{report}/updateStatus', [AdminReportController::class, 'updateStatus'])->name('reports.updateStatus');

            Route::resource('citizen', AdminCitizenController::class);

            Route::resource('rewards', AdminRewardController::class);
        });
    });
});

require __DIR__ . '/auth.php';
