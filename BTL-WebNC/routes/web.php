<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

// Public routes
Route::get('/', [CourseController::class, 'index'])->name('home');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

// Authentication routes
Auth::routes();

// Protected routes (only accessible to authenticated users)
Route::middleware(['auth'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Student routes
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enrollments.store');
    Route::get('/my-courses', [EnrollmentController::class, 'index'])->name('my-courses');

    
    // Instructor routes
    Route::middleware(['role:instructor'])->group(function () {
        // Instructor-specific course and lesson management
        Route::get('/instructor/courses', [CourseController::class, 'instructorCourses'])->name('instructor.courses');
        Route::resource('courses', CourseController::class)->except(['index', 'show']);
        Route::resource('lessons', LessonController::class);
    });
    
    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/courses', [AdminController::class, 'courses'])->name('admin.courses');
    });

    // Enrollment routes
    Route::delete('/enrollments/{enrollment}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
});
