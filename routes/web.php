<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveRequestController;

Route::get('/leave_requests', [LeaveRequestController::class, 'index'])->name('leave_requests.index');
Route::post('/leave_requests', [LeaveRequestController::class, 'store'])->name('leave_requests.store');
Route::patch('/leave_requests/{leaveRequest}', [LeaveRequestController::class, 'update'])->name('leave_requests.update');