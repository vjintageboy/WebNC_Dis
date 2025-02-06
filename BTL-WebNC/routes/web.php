<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;

// Trang chủ là danh sách khóa học
Route::get('/', [CourseController::class, 'index'])->name('courses.index');

// Nhóm các route yêu cầu đăng nhập
Route::middleware(['auth'])->group(function () {
    Route::resource('courses', CourseController::class)->except(['create', 'store']); // Chỉ dùng GET cho index và show
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
