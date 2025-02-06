<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store($courseId)
{
    Enrollment::create([
        'user_id' => auth()->id(),
        'course_id' => $courseId
    ]);
    return redirect()->back()->with('success', 'Đăng ký khóa học thành công!');
}

}
