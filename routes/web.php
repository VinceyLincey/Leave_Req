<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveRequestController;

Route::get('/leave-requests', [LeaveRequestController::class, 'index'])->name('leave_requests.index');
Route::post('/leave-requests', [LeaveRequestController::class, 'store'])->name('leave_requests.store');
Route::patch('/leave-requests/{leaveRequest}/status', [LeaveRequestController::class, 'updateStatus'])->name('leave_requests.update_status');