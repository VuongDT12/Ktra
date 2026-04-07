<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('courses', CourseController::class);
Route::get('courses/trashed', [CourseController::class, 'trashed'])->name('courses.trashed');
Route::post('courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');

Route::resource('lessons', LessonController::class);

Route::prefix('enrollments')->name('enrollments.')->group(function () {
    Route::get('create', [EnrollmentController::class, 'create'])->name('create');
    Route::post('/', [EnrollmentController::class, 'store'])->name('store');
    Route::get('course/{course}', [EnrollmentController::class, 'index'])->name('index');
});
