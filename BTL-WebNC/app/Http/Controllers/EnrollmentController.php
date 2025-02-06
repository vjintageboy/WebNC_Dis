<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        // Lấy danh sách khóa học đã đăng ký của user hiện tại
        $enrollments = Enrollment::where('user_id', auth()->id())
            ->with('course')
            ->get();
        return view('enrollments.index', compact('enrollments'));
    }

    public function store($courseId)
    {
        // Kiểm tra xem đã đăng ký chưa
        $exists = Enrollment::where('user_id', auth()->id())
            ->where('course_id', $courseId)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Bạn đã đăng ký khóa học này rồi!');
        }

        // Tạo enrollment mới
        Enrollment::create([
            'user_id' => auth()->id(),
            'course_id' => $courseId,
            'status' => 'active'
        ]);

        return redirect()->back()->with('success', 'Đăng ký khóa học thành công!');
    }

    public function show(Enrollment $enrollment)
    {
        // Kiểm tra quyền truy cập
        if ($enrollment->user_id !== auth()->id()) {
            abort(403);
        }

        return view('enrollments.show', compact('enrollment'));
    }

    public function destroy(Enrollment $enrollment)
    {
        // Kiểm tra quyền
        if ($enrollment->user_id !== auth()->id()) {
            abort(403);
        }

        $enrollment->delete();
        return redirect()->route('enrollments.index')
            ->with('success', 'Đã hủy đăng ký khóa học.');
    }
}