<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkInstructionController;
use Illuminate\Support\Facades\Route;

include 'auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('units', UnitController::class);
    Route::resource('work-instructions', WorkInstructionController::class);
    Route::resource('work-instructions.assignments', AssignmentController::class);
    Route::get('daily-reports', DailyReportController::class)->name('daily-report.index');
    Route::get('monthly-reports', MonthlyReportController::class)->name('monthly-report.index');
});

Route::view('/', 'welcome')->name('home');
