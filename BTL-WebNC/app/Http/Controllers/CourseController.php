<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('instructor')->paginate(12);
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load(['lessons', 'instructor']);
        $isEnrolled = Auth::check() ? $course->enrollments()->where('user_id', Auth::id())->exists() : false;
        return view('courses.show', compact('course', 'isEnrolled'));
    }

    public function create()
    {
        // $this->authorize('create', Course::class);
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Course::class);
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('courses', 'public');
            $validated['image'] = $path;
        }

        $validated['instructor_id'] = Auth::id();
        $validated['status'] = 'active';

        Course::create($validated);

        return redirect()->route('courses.index')
            ->with('success', 'Khóa học đã được tạo thành công.');
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            // Upload ảnh mới
            $path = $request->file('image')->store('courses', 'public');
            $validated['image'] = $path;
        }

        $course->update($validated);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Khóa học đã được cập nhật thành công.');
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        // Xóa ảnh khóa học
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Khóa học đã được xóa thành công.');
    }
}

