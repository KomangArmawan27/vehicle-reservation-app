<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\HomeDashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ApprovalController;

use App\Exports\ReservationsExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/report', [ChartController::class, 'index'])->name('dashboard.chart');
    
    Route::get('/dashboard/report/export', function(Request $request) {
        $start = $request->input('start_date');
        $end = $request->input('end_date');
    
        return Excel::download(new ReservationsExport($start, $end), 'reservations.xlsx');
    })->name('admin.export');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeDashboardController::class, 'index'])->name('dashboard.home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

    Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals.index');
    Route::put('/approvals/{approval}', [ApprovalController::class, 'update'])->name('approvals.update');
});

require __DIR__.'/auth.php';
