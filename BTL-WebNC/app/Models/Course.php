<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    // Các trường được phép gán giá trị hàng loạt
    protected $fillable = [
        'title',         // Tiêu đề khóa học
        'description',   // Mô tả khóa học
        'image',         // Hình ảnh đại diện của khóa học
        'price',         // Giá của khóa học
        'status',        // Trạng thái (ví dụ: active, inactive)
        'instructor_id'  // ID của giảng viên tạo khóa học
    ];

    // Quan hệ 1 - N: Một khóa học có nhiều bài học
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // Quan hệ 1 - N: Một khóa học có nhiều đăng ký
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Quan hệ N - 1: Một khóa học thuộc về một giảng viên (User)
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}