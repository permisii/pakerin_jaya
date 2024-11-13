<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\OPController;
use App\Http\Controllers\PCController;
use App\Http\Controllers\PPController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\ServiceCardController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkInstructionController;
use App\Http\Controllers\WorkProcessController;
use Illuminate\Support\Facades\Route;

include 'auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('users', UserController::class);
    Route::put('users/{user}/update-access', [UserController::class, 'updateAccess'])->name('users.update-access');
    Route::put('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::resource('units', UnitController::class);
    Route::resource('work-instructions', WorkInstructionController::class);
    Route::resource('work-instructions.assignments', AssignmentController::class);
    Route::resource('assignments', AssignmentController::class); // Might conflict with the above route
    Route::get('daily-reports', DailyReportController::class)->name('daily-report.index');
    Route::get('monthly-reports', MonthlyReportController::class)->name('monthly-report.index');
    Route::resource('pcs', PCController::class);
    Route::get('pcs/{pc}/service-cards', [PCController::class, 'serviceCards'])->name('pcs.service-cards.index');
    Route::get('printers/{printer}/service-cards', [PrinterController::class, 'serviceCards'])->name('printers.service-cards.index');
    Route::resource('printers', PrinterController::class);
    Route::resource('service-cards', ServiceCardController::class);
    Route::resource('work-processes', WorkProcessController::class);
    Route::resource('pps', PPController::class);
    Route::resource('ops', OPController::class);
});

Route::view('/', 'auth.login')->name('home');
