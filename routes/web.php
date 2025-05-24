<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('layout');
});

Route::resource('/students', StudentController::class);

Route::resource('/teachers', TeacherController::class);

Route::resource('/courses', CourseController::class);

Route::resource('/batches', BatchController::class);

Route::resource('/enrollments', EnrollmentController::class);

Route::resource('/payments', PaymentController::class);

Route::resource('attendances', AttendanceController::class);

// Additional attendance routes
Route::get('batches/{batch}/attendances', [AttendanceController::class, 'byBatch'])->name('attendances.by-batch');
Route::get('students/{student}/attendances', [AttendanceController::class, 'byStudent'])->name('attendances.by-student');
Route::get('batches/{batch}/attendances/bulk-create', [AttendanceController::class, 'bulkCreate'])->name('attendances.bulk-create');
Route::post('batches/{batch}/attendances/bulk-store', [AttendanceController::class, 'bulkStore'])->name('attendances.bulk-store');

Route::get('/payments/print/{id}', [App\Http\Controllers\ReportController::class, 'printReceipt'])->name('payments.print');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');